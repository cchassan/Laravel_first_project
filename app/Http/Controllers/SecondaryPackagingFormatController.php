<?php

namespace App\Http\Controllers;

use App\Models\SecondaryPackagingFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class SecondaryPackagingFormatController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:secondaryPackagingFormat-list|secondaryPackagingFormat-create|secondaryPackagingFormat-edit|secondaryPackagingFormat-delete', ['only' => ['index','store']]);
        $this->middleware('permission:secondaryPackagingFormat-create', ['only' => ['create','store']]);
        $this->middleware('permission:secondaryPackagingFormat-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:secondaryPackagingFormat-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $secondaryPackagingFormat = SecondaryPackagingFormat::get();
        if($request->ajax()){
            return DataTables::of($secondaryPackagingFormat)
                ->addIndexColumn()
                ->addColumn('action',  function($row) {
                    if(Gate::allows('secondaryPackagingFormat-delete')){
                        $deleteButton = '<button class="btn btn-sm btn-danger delBtn" data-id="'.$row->secondaryPackagingFormat_id.'"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    }
                    else {
                        $deleteButton = '';
                    }
                    if(Gate::allows('secondaryPackagingFormat-edit')) {
                        $viewBtn = '<a href="javascript:void(0)" class="btn btn-primary editBtn" data-id="' . $row->secondaryPackagingFormat_id . '" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a> &nbsp;';
                    }
                    else {
                        $viewBtn ='';
                    }
                    return $viewBtn .$deleteButton;
                })
                ->rawColumns(['action', 'id'])->make(true);
        }

        return view('secondaryPackagingFormat.secondaryPackagingFormat');
    }

    public function store(Request $request){
        if($request->secondaryPackagingFormatId != null) {

            $secondaryPackagingFormat = SecondaryPackagingFormat::find($request->secondaryPackagingFormatId);

            $request->validate([
                'secondaryPackagingFormat_name' =>  'required|string|max:255|unique:secondary_packaging_formats,secondaryPackagingFormatName,' . $secondaryPackagingFormat->secondaryPackagingFormat_id . ',secondaryPackagingFormat_id',
            ]);


            $secondaryPackagingFormat->update([
                'secondaryPackagingFormatName' => $request->secondaryPackagingFormat_name,
            ]);
            return response()->json([
                'success' => 'Secondary Packaging Format updated successfully',
            ], 201);
        }else {

            $request->validate([
                'secondaryPackagingFormat_name' => ['required', 'string', 'max:255', 'unique:secondary_packaging_formats,secondaryPackagingFormatName'],
            ]);
            SecondaryPackagingFormat::create([
                'secondaryPackagingFormatName' => $request->secondaryPackagingFormat_name,
            ]);

            return response()->json([
                'success' => 'Secondary Packaging Format added successfully',
            ], 201);
        }
    }


    public function edit($id) {
        $secondaryPackagingFormat = secondaryPackagingFormat::find($id);

        if(is_null($secondaryPackagingFormat)){
            return redirect()->route('secondaryPackagingFormat');
        }
        else {
            return  $secondaryPackagingFormat;
        }
    }


    public function destroy($id) {
        $secondaryPackagingFormat = SecondaryPackagingFormat::find($id);

        if(is_null($secondaryPackagingFormat)){
            return redirect()->route('secondaryPackagingFormat');
        }
        else {
            $secondaryPackagingFormat->delete();
            return  response()->json(['success' => 'Secondary Packaging Format deleted successfully',
            ], 201);
        }
    }
}
