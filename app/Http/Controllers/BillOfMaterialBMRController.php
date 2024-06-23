<?php

namespace App\Http\Controllers;

use App\Models\BatchType;
use App\Models\BillOfMaterialBMR;
use App\Models\MaterialRecordEntry;
use App\Models\Product;
use App\Models\ProductRecipeItem;
use App\Models\RequestMaterialBMR;
use Illuminate\Http\Request;

class BillOfMaterialBMRController extends Controller
{
    public function create(){
        return view('products.addBillOfMaterialBMR');
    }

    public function getProductCodesBMR(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $productCodes = Product::where('product_code', 'like', "%$query%")->get();
        return response()->json($productCodes);
    }

    public function getBatchTypeBMR(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $batchType = BatchType::where('batchType', 'like', "%$query%")->get();
        return response()->json($batchType);
    }

    public function getItemCodesRecipeBMR(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $itemCodes = MaterialRecordEntry::where('itemCode', 'like', "%$query%")->get();
        return response()->json($itemCodes);
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'bom_bmr_code' => ['required', 'string', 'max:255'],
                'bmr_code' => ['required', 'string', 'max:255', 'unique:bill_of_materialsbmr,bmr_code'],
                'productCode' => ['required', 'string'],
                'batchNumber' => ['required', 'string'],
                'batchType' => ['required', 'string'],
                'batchSize' => ['required', 'string'],
                'measuringUnit' => ['required', 'string'],
                'preparedBy' => ['required', 'string'],
                'preparedOn' => ['required', 'string'],
                'approvedBy' => ['required', 'string'],
                'approvedDate' => ['required', 'string'],
            ]
        );
//        dd($request->all());

        $billOfMaterialBMR = new BillOfMaterialBMR();

        $billOfMaterialBMR->serialNumber = $request->input('serialNumber');
        $billOfMaterialBMR->bom_bmr_code = $request->input('bom_bmr_code');
        $billOfMaterialBMR->bmr_code = $request->input('bmr_code');
        $billOfMaterialBMR->product_Id = $request->input('productCode');
        $billOfMaterialBMR->batch_number = $request->input('batchNumber');
        $billOfMaterialBMR->batchType_Id = $request->input('batchType');
        $billOfMaterialBMR->batch_size = $request->input('batchSize');
        $billOfMaterialBMR->unit_of_measure = $request->input('measuringUnit');
        $billOfMaterialBMR->remarks = $request->input('remarks');
        $billOfMaterialBMR->preparedBy = $request->input('preparedBy');
        $billOfMaterialBMR->preparedOn =$request->input('preparedOn');
        $billOfMaterialBMR->approvedBy = $request->input('approvedBy');
        $billOfMaterialBMR->approvedDate = $request->input('approvedDate');
        $billOfMaterialBMR->save();

        foreach ($request->materialCode as $index => $material) {
            $record = new RequestMaterialBMR();
            $record->billofmaterialbmr_id = $billOfMaterialBMR->billofmaterialbmr_id;
            $record->material_record_id = $material;
            $record->specification = $request->specification[$index];
            $record->standard_quantity = $request->standardQty[$index];
            $record->required_quantity = $request->requiredQty[$index];
            $record->unit_of_measuring = $request->measuring[$index];
            $record->save();
        }
        $message = array(
            'message' => "Bill of material BMR Form Added Successfully.",
            'type' => "success",
        );
        return redirect()->route('billOfMaterialBMR.create')->with($message);
    }

}
