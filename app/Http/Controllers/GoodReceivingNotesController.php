<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceivingNote;
use App\Models\Location;
use App\Models\MaterialReceive;
use App\Models\MaterialRecordEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class GoodReceivingNotesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:goods-receiving-list|goods-receiving-create|goods-receiving-edit|goods-receiving-delete', ['only' => ['index','store']]);
        $this->middleware('permission:goods-receiving-create', ['only' => ['create','store']]);
        $this->middleware('permission:goods-receiving-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:goods-receiving-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $goodsReceivingNote = GoodsReceivingNote::with(['getMaterialItem', 'getWarehouseLocation']) ->get();

        if($request->ajax()){
            return DataTables::of($goodsReceivingNote)->addIndexColumn()
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
                    if (Gate::allows('goods-receiving-delete')) {
                        $deleteButton = '<button onclick="confirmDelete(\'link\', 0, \''.route('goods.Receiving.Notes.delete', $row->goods_receiving_id).'\')"" class="btn btn-sm btn-danger delBtn" data-id="' . $row->goods_receiving_id . '"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    }
                    if (Gate::allows('goods-receiving-list')) {
                        $viewButton = '<button class="btn btn-sm btn-primary viewBtn" data-id="' . $row->goods_receiving_report . '" data-sr="' . $row->serialNumber . '"
                                           data-grncode="'.$row->grnCode .'" data-ponumber="'.$row->poNumber .'" data-vendornumber="'.$row->vendorNumber .'"
                                           data-itemcode="' . $row->getMaterialItem->itemCode . '" data-itemdescription="' . $row->getMaterialItem->itemDescription . '"
                                           data-manufacturername="' . $row->getMaterialItem->manufacturerName . '" data-manufactureraddress="' . $row->manufacturerAddress . '"
                                           data-preparedby="' . $row->preparedBy . '" data-date="' . $row->date . '" data-remarks="' . $row->remarks . '"
                                                data-toggle="tooltip" title="view">
                                                <i class="fa fa-eye"></i>
                                            </button>';
                    }

                    if (Gate::allows('goods-receiving-edit')) {
                        $editButton = '<a href="' . route("goods.Receiving.Notes.edit", $row->goods_receiving_id) . '" class="btn btn-primary editBtn" data-id="'.$row->goods_receiving_id.'" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a>';
                    }
                    return $viewButton .' '.$editButton . ' '.$deleteButton;
                })
                ->rawColumns(['action', 'id', 'material_item', 'warehouse_location'])->make(true);
        }
        return view('reports/goods_receiving_report');
//        return $materialReceive;
    }

    public function create(){
        $locations = Location::get();
        return view('materialForms.goodReceivingForm')->with(compact('locations'));
    }

    public function getItemCodesGRN(Request $request)
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
                'grnCode' => ['required', 'string','unique:goods_receiving_notes,grnCode'],
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
        $goodsReceivingNote = new GoodsReceivingNote;
        $goodsReceivingNote->serialNumber = $request->serialNumber;
        $goodsReceivingNote-> grnCode = $request->grnCode;
        $goodsReceivingNote-> poNumber = $request->poNumber;
        $goodsReceivingNote->vendorNumber = $request->vendorNumber;
        $goodsReceivingNote->material_record_id = $request->itemCode;
        $goodsReceivingNote->unitOfMeasuring = $request->measuring;
        $goodsReceivingNote->supplier = $request->supplier;
        $goodsReceivingNote->batchNo = $request->batchNo;
        $goodsReceivingNote->mfgDate = $request->mfgDate;
        $goodsReceivingNote->expDate = $request->expDate;
        $goodsReceivingNote->location_id = $request->locationName;
        $goodsReceivingNote->totalQuantity = $request->totalQuantity;
        $goodsReceivingNote->numberOfPackage = $request->numberOfPackage;
        $goodsReceivingNote->deliveryChallanNumber = $request->deliveryChallanNumber;
        $goodsReceivingNote->coaAttached = $request->coaAttached;
        $goodsReceivingNote->materialControlNumber = $request->materialControlNumber;
        $goodsReceivingNote->quantityReceived = $request->quantityReceived;
        $goodsReceivingNote->quantityRejected = $request->quantityRejected;
        $goodsReceivingNote->damagedQuantity = $request->damagedQuantity;
        $goodsReceivingNote->preparedBy = $request->preparedBy;
        $goodsReceivingNote->date = $request->date;
        $goodsReceivingNote->remarks = $request->remarks;

        $goodsReceivingNote->save();
        $message = array(
            'message' => "Goods Receiving Note Added Successfully.",
            'type'=> "success",
        );
        return redirect()->route('goods.Receiving.Notes') ->with($message);
    }


    public function edit($id)
    {
        $goodsReceivingNote = GoodsReceivingNote::with(['getMaterialItem', 'getWarehouseLocation'])->find($id);
        if(is_null($goodsReceivingNote)){
            return redirect()->route('reports.goods.Receiving.Report');
        }
        else {
            $locations = Location::get();
            $data = compact(['goodsReceivingNote', 'locations']);
        }
        return view('materialForms.editGoodsReceivingForm')->with($data);
    }

    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $goodsReceivingNote = GoodsReceivingNote::find($id);
//        dd($request->all());
//        dd($request->itemCode ?? $materialReceive->material_record_id);
        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'grnCode' => 'required|string|unique:goods_receiving_notes,grnCode,' . $goodsReceivingNote->goods_receiving_id .',goods_receiving_id',
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

        $goodsReceivingNote->serialNumber = $request->serialNumber;
        $goodsReceivingNote->grnCode = $request->grnCode;
        $goodsReceivingNote->poNumber = $request->poNumber;
        $goodsReceivingNote->vendorNumber = $request->vendorNumber;
        $goodsReceivingNote->material_record_id = $request->itemCode;
        $goodsReceivingNote->unitOfMeasuring = $request->measuring;
        $goodsReceivingNote->supplier = $request->supplier;
        $goodsReceivingNote->batchNo = $request->batchNo;
        $goodsReceivingNote->mfgDate = $request->mfgDate;
        $goodsReceivingNote->expDate = $request->expDate;
        $goodsReceivingNote->location_id = $request->locationName;
        $goodsReceivingNote->totalQuantity = $request->totalQuantity;
        $goodsReceivingNote->numberOfPackage = $request->numberOfPackage;
        $goodsReceivingNote->deliveryChallanNumber = $request->deliveryChallanNumber;
        $goodsReceivingNote->coaAttached = $request->coaAttached;
        $goodsReceivingNote->materialControlNumber = $request->materialControlNumber;
        $goodsReceivingNote->quantityReceived = $request->quantityReceived;
        $goodsReceivingNote->quantityRejected = $request->quantityRejected;
        $goodsReceivingNote->damagedQuantity = $request->damagedQuantity;
        $goodsReceivingNote->preparedBy = $request->preparedBy;
        $goodsReceivingNote->date = $request->date;
        $goodsReceivingNote->remarks = $request->remarks;

        $goodsReceivingNote->update();
        $message = array(
            'message' => "Goods Receiving Note Updated Successfully.",
            'type'=> "success",
        );
        return redirect()->route('goods.Receiving.Report') ->with($message);
    }

    public function delete ($id){
        $goodsReceivingNote = GoodsReceivingNote::find($id);
//        dd($goodsReceivingNote);
        if(!is_null($goodsReceivingNote)) {
            $goodsReceivingNote->delete();
        }
        $message = array(
            'message' => "Material Receiving Report Delete Successfully.",
            'type'=> "success",
        );
        return redirect()->route('goods.Receiving.Report') -> with($message);
    }
}
