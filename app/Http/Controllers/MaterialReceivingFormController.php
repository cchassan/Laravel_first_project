<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MaterialRecordEntry;
use App\Models\MaterialReceive;
use Illuminate\Http\Request;

class MaterialReceivingFormController extends Controller
{
    public function index(){
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
}
