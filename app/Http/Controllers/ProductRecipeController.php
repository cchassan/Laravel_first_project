<?php

namespace App\Http\Controllers;

use App\Models\MaterialRecordEntry;
use App\Models\Product;
use App\Models\ProductRecipe;
use App\Models\ProductRecipeItem;
use Illuminate\Http\Request;

class ProductRecipeController extends Controller
{
    public function create()
    {
        return view('products.addProductRecipe');
    }

    public function getProductCodes(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $productCodes = Product::where('product_code', 'like', "%$query%")->get();
        return response()->json($productCodes);
    }

    public function getItemCodesRecipe(Request $request)
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
                'productRecipeCode' => ['required', 'string', 'max:255'],
                'productCode' => ['required', 'string'],
                'preparedBy' => ['required', 'string'],
            ]
        );

        $productRecipe = new ProductRecipe();
        $productRecipe->serialNumber = $request->serialNumber;
        $productRecipe->product_recipe_code = $request->productRecipeCode;
        $productRecipe->product_id = $request->productCode;
        $productRecipe->preparedBy = $request->preparedBy;

        $productRecipe->save();

        foreach ($request->materialCode as $index => $material) {
            $record = new ProductRecipeItem();
            $record->product_recipe_id = $productRecipe->product_recipe_id;
            $record->material_record_id = $material;
            $record->materialType = $request->materialType[$index];
            $record->quantity = $request->quantity[$index];
            $record->unit_of_measuring = $request->measuring[$index];
            $record->save();
        }
        $message = array(
            'message' => "Product Recipe Form Added Successfully.",
            'type' => "success",
        );
        return redirect()->route('productRecipe.create')->with($message);
    }
}
