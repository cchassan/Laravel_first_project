<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RouteAdministration;
use App\Models\SecondaryPackagingFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $product = Product::with(['getRouteAdministration', 'getSecondaryPackagingFormat']) ->get();

        if($request->ajax()){
            return
                DataTables::of($product)
                    ->addIndexColumn()
                ->addColumn('route_administration', function($row) {
                    return $row->getRouteAdministration->routeAdministrationName ?? ""; // Accessing related data
                })
                ->addColumn('secondary_packaging_format', function($row) {

                    return $row->getSecondaryPackagingFormat->secondaryPackagingFormatName ?? ""; // Accessing related data
                })
                ->addColumn('action',  function($row) {
                    $deleteButton = '';
                    $viewButton = '';
                    $editButton = '';
                    if (Gate::allows('product-delete')) {
                        $deleteButton = '<button onclick="confirmDelete(\'link\', 0, \''.route('product.delete', $row->product_id).'\')"" class="btn btn-sm btn-danger delBtn" data-id="' . $row->id . '"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    }
                    if (Gate::allows('product-list')) {
                        $viewButton = '<button class="btn btn-sm btn-primary viewBtn" data-id="' . $row->product_id . '" data-sr="' . $row->serialNumber . '"
                                                data-toggle="tooltip" title="view">
                                                <i class="fa fa-eye"></i>
                                            </button>';
                    }

                    if (Gate::allows('product-edit')) {
                        $editButton = '<a href="' . route("product.edit", $row->product_id) . '" class="btn btn-primary editBtn" data-id="'.$row->product_id.'" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a>';
                    }
                    return $viewButton .' '. $editButton . ' '.$deleteButton;
                })
                ->rawColumns(['action', 'id', 'route_administration', 'secondary_packaging_format'])->make(true);
        }
        return view('reports/product_report');
//        return $materialReceive;
    }
    public function create(){
        return view('products.addProduct');
    }

    public function getRouteAdministration(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $routeAdministration = RouteAdministration::where('routeAdministrationName', 'like', "%$query%")->get();
        return response()->json($routeAdministration);
    }

    public function getSecondaryPackagingFormat(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $secondaryPackagingFormat = SecondaryPackagingFormat::where('secondaryPackagingFormatName', 'like', "%$query%")->get();
        return response()->json($secondaryPackagingFormat);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'productCode' => ['required', 'string','unique:products,product_code'],
                'productName' => ['required', 'string', 'max:255'],
                'genericName' => ['required', 'string','max:255'],
                'strength' => ['required', 'string',],
                'fillVolume' => ['required', 'string'],
                'batchSizeLiter' => ['required', 'integer'],
                'batchSizeVials' => ['required', 'integer'],
                'routeAdministration' => ['required', 'string'],
                'secondaryPackageFormat' => ['required', 'string'],
                'preparedBy' => ['required', 'string'],
                'addedBy' => ['required', 'String'],
            ]
        );


        $product = new Product;
        $product->serialNumber = $request->serialNumber;
        $product->product_code = $request->productCode;
        $product->product_name = $request->productName;
        $product->generic_name = $request->genericName;
        $product->strength = $request->strength;
        $product->fill_volume = $request->fillVolume;
        $product->batch_size_liter = $request->batchSizeLiter;
        $product->batch_size_vial = $request->batchSizeVials;
        $product->routeAdministration_id = $request->routeAdministration;
        $product->secondaryPackagingFormat_id = $request->secondaryPackageFormat;
        $product->preparedBy = $request->preparedBy;
        $product->addedBy = $request->addedBy;

        $product->save();
        $message = array(
            'message' => "Product Added Successfully.",
            'type'=> "success",
        );
        return redirect()->route('product.create') ->with($message);
    }

    public function edit($id)
    {
        $product = Product::with(['getRouteAdministration', 'getSecondaryPackagingFormat'])->find($id);
        if(is_null($product)){
            return redirect()->route('product.Report');
        }
        else {
            $data = compact(['product']);
        }
        return view('materialForms.editProduct')->with($data);
    }


    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $product = Product::find($id);
//        dd($request->all());
//        dd($request->itemCode ?? $materialReceive->material_record_id);
        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'productCode' => 'required|string|unique:products,product_code,' . $product->product_id .',product_id',
                'productName' => ['required', 'string', 'max:255'],
                'genericName' => ['required', 'string','max:255'],
                'strength' => ['required', 'string',],
                'fillVolume' => ['required', 'string'],
                'batchSizeLiter' => ['required', 'integer'],
                'batchSizeVials' => ['required', 'integer'],
                'routeAdministration' => ['required', 'string'],
                'secondaryPackageFormat' => ['required', 'string'],
                'preparedBy' => ['required', 'string'],
                'addedBy' => ['required', 'String'],
            ]
        );

        $product->serialNumber = $request->serialNumber;
        $product->product_code = $request->productCode;
        $product->product_name = $request->productName;
        $product->generic_name = $request->genericName;
        $product->strength = $request->strength;
        $product->fill_volume = $request->fillVolume;
        $product->batch_size_liter = $request->batchSizeLiter;
        $product->batch_size_vial = $request->batchSizeVials;
        $product->routeAdministration_id = $request->routeAdministration;
        $product->secondaryPackagingFormat_id = $request->secondaryPackageFormat;
        $product->preparedBy = $request->preparedBy;
        $product->addedBy = $request->addedBy;

        $product->update();
        $message = array(
            'message' => "Product Updated Successfully.",
            'type'=> "success",
        );
        return redirect()->route('product.Report') ->with($message);
    }

    public function delete ($id){
        $product = Product::find($id);
//        dd($product);
        if(!is_null($product)) {
            $product->delete();
        }
        $message = array(
            'message' => "Product Delete Successfully.",
            'type'=> "success",
        );
        return redirect()->route('product.Report') -> with($message);
    }
}
