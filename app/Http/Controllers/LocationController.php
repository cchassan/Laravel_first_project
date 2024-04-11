<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index','store']]);
        $this->middleware('permission:location-create', ['only' => ['create','store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $locations = Location::get();
        if($request->ajax()){
            return DataTables::of($locations)
                ->addIndexColumn()
                ->addColumn('action',  function($row) {
                    if(Gate::allows('location-delete')){
                    $deleteButton = '<button class="btn btn-sm btn-danger delBtn" data-id="'.$row->location_id.'"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                        }
                    else {
                        $deleteButton = '';
                    }
                    if(Gate::allows('location-edit')) {
                        $viewBtn = '<a href="javascript:void(0)" class="btn btn-primary editBtn" data-id="' . $row->location_id . '" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a> &nbsp;';
                    }
                    else {
                        $viewBtn ='';
                    }
                    return $viewBtn .$deleteButton;
                })
                ->rawColumns(['action', 'id'])->make(true);
        }

        return view('location/location');
    }

    public function store(Request $request){
        if($request->locationId != null) {

            $location = Location::find($request->locationId);

            $request->validate([
                'location_name' =>  'required|string|max:255|unique:locations,locationName,' . $location->location_id . ',location_id',
            ]);


            $location->update([
                    'locationName' => $request->location_name,
                ]);
                return response()->json([
                    'success' => 'Location updated successfully',
                ], 201);
        }else {

            $request->validate([
                'location_name' => ['required', 'string', 'max:255', 'unique:locations,locationName'],
            ]);
            Location::create([
                'locationName' => $request->location_name,
            ]);

            return response()->json([
                'success' => 'Location added successfully',
            ], 201);
        }
    }


    public function edit($id) {
        $location = Location::find($id);

        if(is_null($location)){
            return redirect()->route('location');
        }
        else {
            return  $location;
        }
    }


    public function destroy($id) {
        $location = Location::find($id);

        if(is_null($location)){
            return redirect()->route('location');
        }
        else {
            $location->delete();
            return  response()->json(['success' => 'Location deleted successfully',
            ], 201);
        }
    }

}
