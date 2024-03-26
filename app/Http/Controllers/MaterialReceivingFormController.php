<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MaterialRecordEntry;
use App\Models\MaterialReceive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class MaterialReceivingFormController extends Controller
{
    public function index(Request $request){
        $materialReceive = MaterialReceive::with(['getMaterialItem', 'getWarehouseLocation']) ->get();

        if($request->ajax()){
            return DataTables::of($materialReceive)->addIndexColumn()
                ->addColumn('material_item', function($row) {
                    return $row->getMaterialItem->itemCode ?? ""; // Accessing related data
                })
                ->addColumn('warehouse_location', function($row) {

                    return $row->getWarehouseLocation->locationName ?? ""; // Accessing related data
                })
                ->addColumn('action',  function($row) {
                    $deleteButton = '';
                    $viewButton = '';
                    $editButton = '';
                    if (Gate::allows('material-record-Entry-delete')) {
                        $deleteButton = '<button onclick="confirmDelete(\'link\', 0, \''.route('material.Receiving.Form.delete', $row->material_receive_id).'\')"" class="btn btn-sm btn-danger delBtn" data-id="' . $row->id . '"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    }
                    if (Gate::allows('material-record-Entry-list')) {
                        $viewButton = '<button class="btn btn-sm btn-primary viewBtn" data-id="' . $row->material_receive_id . '" data-sr="' . $row->serialNumber . '"
                                           data-mrrcode="'.$row->mrrCode .'" data-ponumber="'.$row->poNumber .'" data-vendornumber="'.$row->vendorNumber .'"
                                           data-itemcode="' . $row->getMaterialItem->itemCode . '" data-itemdescription="' . $row->getMaterialItem->itemDescription . '"
                                           data-manufacturername="' . $row->getMaterialItem->manufacturerName . '" data-manufactureraddress="' . $row->manufacturerAddress . '"
                                           data-preparedby="' . $row->preparedBy . '" data-date="' . $row->date . '" data-remarks="' . $row->remarks . '"
                                                data-toggle="tooltip" title="view">
                                                <i class="fa fa-eye"></i>
                                            </button>';
                    }

                    if (Gate::allows('material-record-Entry-edit')) {
                        $editButton = '<a href="' . route("material.Receiving.Form.edit", $row->material_receive_id) . '" class="btn btn-primary editBtn" data-id="'.$row->material_record_id.'" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a>';
                    }
                    return $editButton . ' '.$deleteButton;
                })
                ->rawColumns(['action', 'id', 'material_item', 'warehouse_location'])->make(true);
        }
        return view('reports/material_receive_report');
//        return $materialReceive;
    }
    public function create(){
        $locations = Location::get();
        return view('materialForms.materialReceivingForm')->with(compact('locations'));
    }


    public function getItemCodes(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $itemCodes = MaterialRecordEntry::where('itemCode', 'like', "%$query%")->get();
        return response()->json($itemCodes);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'mrrCode' => ['required', 'string','unique:material_receives,mrrCode'],
                'poNumber' => ['required', 'string', 'max:255'],
                'vendorNumber' => ['required', 'string','max:255'],
                'itemCode' => ['required', 'string',],
                'measuring' => ['required', 'string'],
                'supplier' => ['required', 'string', 'max:255'],
                'batchNo' => ['required', 'string'],
                'mfgDate' => ['required', 'date'],
                'expDate' => ['required', 'date'],
                'locationName' => ['required', 'string'],
                'totalQuantity' => ['required', 'integer'],
                'numberOfPackage' => ['required', 'integer'],
                'deliveryChallanNumber' => ['required', 'string'],
                'coaAttached' => ['required', 'string'],
                'materialControlNumber' => ['required', 'integer'],
                'quantityReceived' => ['required', 'integer'],
                'quantityRejected' => ['required', 'integer'],
                'preparedBy' => ['required', 'string'],
                'date' => ['required', 'date'],
            ]
        );


        $materialReceive = new MaterialReceive;
        $materialReceive->serialNumber = $request->serialNumber;
        $materialReceive->mrrCode = $request->mrrCode;
        $materialReceive->poNumber = $request->poNumber;
        $materialReceive->vendorNumber = $request->vendorNumber;
        $materialReceive->material_record_id = $request->itemCode;
        $materialReceive->unitOfMeasuring = $request->measuring;
        $materialReceive->supplier = $request->supplier;
        $materialReceive->batchNo = $request->batchNo;
        $materialReceive->mfgDate = $request->mfgDate;
        $materialReceive->expDate = $request->expDate;
        $materialReceive->location_id = $request->locationName;
        $materialReceive->totalQuantity = $request->totalQuantity;
        $materialReceive->numberOfPackage = $request->numberOfPackage;
        $materialReceive->deliveryChallanNumber = $request->deliveryChallanNumber;
        $materialReceive->coaAttached = $request->coaAttached;
        $materialReceive->materialControlNumber = $request->materialControlNumber;
        $materialReceive->quantityReceived = $request->quantityReceived;
        $materialReceive->quantityRejected = $request->quantityRejected;
        $materialReceive->damagedQuantity = $request->damagedQuantity;
        $materialReceive->preparedBy = $request->preparedBy;
        $materialReceive->date = $request->date;
        $materialReceive->remarks = $request->remarks;

        $materialReceive->save();
        $message = array(
            'message' => "Material Receiving Form Added Successfully.",
            'type'=> "success",
        );
            return redirect()->route('material.Receiving.Form') ->with($message);
    }

    public function edit($id)
    {
     $materialReceive = MaterialReceive::with(['getMaterialItem', 'getWarehouseLocation'])->find($id);
        if(is_null($materialReceive)){
            return redirect()->route('reports.material.Receiving.Report');
        }
        else {
            $locations = Location::get();
            $data = compact(['materialReceive', 'locations']);
        }
        return view('materialForms.editMaterialReceivingForm')->with($data);
    }


    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $materialReceive = MaterialReceive::find($id);
//        dd($request->all());
//        dd($request->itemCode ?? $materialReceive->material_record_id);
        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'mrrCode' => 'required|string|unique:material_receives,mrrCode,' . $materialReceive->material_receive_id .',material_receive_id',
                'poNumber' => ['required', 'string', 'max:255'],
                'vendorNumber' => ['required', 'string','max:255'],
                'itemCode' => ['required', 'string',],
                'measuring' => ['required', 'string'],
                'supplier' => ['required', 'string', 'max:255'],
                'batchNo' => ['required', 'string'],
                'mfgDate' => ['required', 'date'],
                'expDate' => ['required', 'date'],
                'locationName' => ['required', 'string'],
                'totalQuantity' => ['required', 'integer'],
                'numberOfPackage' => ['required', 'integer'],
                'deliveryChallanNumber' => ['required', 'string'],
                'coaAttached' => ['required', 'string'],
                'materialControlNumber' => ['required', 'integer'],
                'quantityReceived' => ['required', 'integer'],
                'quantityRejected' => ['required', 'integer'],
                'preparedBy' => ['required', 'string'],
                'date' => ['required', 'date'],
            ]
        );

        $materialReceive->serialNumber = $request->serialNumber;
        $materialReceive->mrrCode = $request->mrrCode;
        $materialReceive->poNumber = $request->poNumber;
        $materialReceive->vendorNumber = $request->vendorNumber;
        $materialReceive->material_record_id = $request->itemCode;
        $materialReceive->unitOfMeasuring = $request->measuring;
        $materialReceive->supplier = $request->supplier;
        $materialReceive->batchNo = $request->batchNo;
        $materialReceive->mfgDate = $request->mfgDate;
        $materialReceive->expDate = $request->expDate;
        $materialReceive->location_id = $request->locationName;
        $materialReceive->totalQuantity = $request->totalQuantity;
        $materialReceive->numberOfPackage = $request->numberOfPackage;
        $materialReceive->deliveryChallanNumber = $request->deliveryChallanNumber;
        $materialReceive->coaAttached = $request->coaAttached;
        $materialReceive->materialControlNumber = $request->materialControlNumber;
        $materialReceive->quantityReceived = $request->quantityReceived;
        $materialReceive->quantityRejected = $request->quantityRejected;
        $materialReceive->damagedQuantity = $request->damagedQuantity;
        $materialReceive->preparedBy = $request->preparedBy;
        $materialReceive->date = $request->date;
        $materialReceive->remarks = $request->remarks;

        $materialReceive->update();
        $message = array(
            'message' => "Material Receiving Form Updated Successfully.",
            'type'=> "success",
        );
        return redirect()->route('material.Receiving.Report') ->with($message);
    }

    public function delete ($id){
        $materialReceive = MaterialReceive::find($id);
        dd($materialReceive);
        if(!is_null($materialReceive)) {
            $materialReceive->delete();
        }
        $message = array(
            'message' => "Material Receiving Report Delete Successfully.",
            'type'=> "success",
        );
        return redirect()->route('material.Receiving.Report') -> with($message);
    }
}
