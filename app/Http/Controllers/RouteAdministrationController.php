<?php

namespace App\Http\Controllers;

use App\Models\RouteAdministration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class RouteAdministrationController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:routeAdministration-list|routeAdministration-create|routeAdministration-edit|routeAdministration-delete', ['only' => ['index','store']]);
        $this->middleware('permission:routeAdministration-create', ['only' => ['create','store']]);
        $this->middleware('permission:routeAdministration-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:routeAdministration-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $routeAdministration = RouteAdministration::get();
        if($request->ajax()){
            return DataTables::of($routeAdministration)
                ->addIndexColumn()
                ->addColumn('action',  function($row) {
                    if(Gate::allows('routeAdministration-delete')){
                        $deleteButton = '<button class="btn btn-sm btn-danger delBtn" data-id="'.$row->routeAdministration_id.'"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    }
                    else {
                        $deleteButton = '';
                    }
                    if(Gate::allows('routeAdministration-edit')) {
                        $viewBtn = '<a href="javascript:void(0)" class="btn btn-primary editBtn" data-id="' . $row->routeAdministration_id . '" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a> &nbsp;';
                    }
                    else {
                        $viewBtn ='';
                    }
                    return $viewBtn .$deleteButton;
                })
                ->rawColumns(['action', 'id'])->make(true);
        }

        return view('routeAdministration.routeAdministration');
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->routeAdministrationId != null) {

            $routeAdministration = RouteAdministration::find($request->routeAdministrationId);

            $request->validate([
                'routeAdministration_name' =>  'required|string|max:255|unique:route_administrations,routeAdministrationName,' . $routeAdministration->routeAdministration_id . ',routeAdministration_id',
            ]);


            $routeAdministration->update([
                'routeAdministrationName' => $request->routeAdministration_name,
            ]);
            return response()->json([
                'success' => 'Route Administration updated successfully',
            ], 201);
        }else {

            $request->validate([
                'routeAdministration_name' => ['required', 'string', 'max:255', 'unique:route_administrations,routeAdministrationName'],
            ]);
            RouteAdministration::create([
                'routeAdministrationName' => $request->routeAdministration_name,
            ]);

            return response()->json([
                'success' => 'Route Administration added successfully',
            ], 201);
        }
    }


    public function edit($id) {
        $routeAdministration = RouteAdministration::find($id);

        if(is_null($routeAdministration)){
            return redirect()->route('routeAdministration');
        }
        else {
            return  $routeAdministration;
        }
    }


    public function destroy($id) {
        $routeAdministration = RouteAdministration::find($id);

        if(is_null($routeAdministration)){
            return redirect()->route('routeAdministration');
        }
        else {
            $routeAdministration->delete();
            return  response()->json(['success' => 'Route Administration deleted successfully',
            ], 201);
        }
    }
}
