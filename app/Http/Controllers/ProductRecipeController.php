<?php

namespace App\Http\Controllers;

use App\Models\MaterialRecordEntry;
use App\Models\Product;
use App\Models\ProductRecipe;
use App\Models\ProductRecipeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

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

    public function index(Request $request){
        $productRecipe = ProductRecipe::with(['getProduct', 'getProductRecipeItems']) ->get();

//        dd($productRecipe->toArray());

        if($request->ajax()){
            return DataTables::of($productRecipe)->addIndexColumn()
                ->addColumn('getProduct', function($row) {
                    return $row->getProduct->product_name ?? ""; // Accessing related data
                })
                ->addColumn('action',  function($row) {
                    $deleteButton = '';
                    $viewButton = '';
                    $editButton = '';
//                    if (Gate::allows('material-receiving-delete')) {
                        $deleteButton = '<button onclick="confirmDelete(\'link\', 0, \''.route('product.Recipe.delete', $row->product_recipe_id).'\')"" class="btn btn-sm btn-danger delBtn" data-id="' . $row->id . '"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
//                    }
//                    if (Gate::allows('material-receiving-list')) {
//                        $viewButton = '<button class="btn btn-sm btn-primary viewBtn" data-id="' . $row->material_receive_id . '" data-sr="' . $row->serialNumber . '"
//                                           data-mrrcode="'.$row->mrrCode .'" data-ponumber="'.$row->poNumber .'" data-vendornumber="'.$row->vendorNumber .'"
//                                           data-itemcode="' . $row->getMaterialItem->itemCode . '" data-itemdescription="' . $row->getMaterialItem->itemDescription . '"
//                                           data-manufacturername="' . $row->getMaterialItem->manufacturerName . '" data-manufactureraddress="' . $row->manufacturerAddress . '"
//                                           data-preparedby="' . $row->preparedBy . '" data-date="' . $row->date . '" data-remarks="' . $row->remarks . '"
//                                                data-toggle="tooltip" title="view">
//                                                <i class="fa fa-eye"></i>
//                                            </button>';
//                    }

//                    if (Gate::allows('material-receiving-edit')) {
                        $editButton = '<a href="' . route("product.Recipe.edit", $row->product_recipe_id) . '" class="btn btn-primary editBtn" data-id="'.$row->product_recipe_id.'" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a>';
//                    }
                    return $viewButton .' '. $editButton . ' '.$deleteButton;
                })
                ->rawColumns(['action', 'id', 'getProduct'])->make(true);
        }
        return view('reports/product_recipe_report');
    }

    public function edit($id)
    {
        $productRecipe = ProductRecipe::with(['getProduct', 'getProductRecipeItems', 'getMaterialItem']) ->find($id);
//        dd($productRecipe->toArray());
        if(is_null($productRecipe)){
            return redirect()->route('product.Recipe.Report');
        }
        else {
            $data = compact(['productRecipe']);
        }
        return view('products.product_recipe_edit')->with($data);
    }

}
