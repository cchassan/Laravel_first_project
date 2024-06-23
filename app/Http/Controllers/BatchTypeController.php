<?php


namespace App\Http\Controllers;

use App\Models\BatchType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class BatchTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:batchType-list|batchType-create|batchType-edit|batchType-delete', ['only' => ['index','store']]);
        $this->middleware('permission:batchType-create', ['only' => ['create','store']]);
        $this->middleware('permission:batchType-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:batchType-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $batchtypes = BatchType::get();
        if($request->ajax()){
            return DataTables::of($batchtypes)
                ->addIndexColumn()
                ->addColumn('action',  function($row) {
                    if(Gate::allows('batchType-delete')){
                        $deleteButton = '<button class="btn btn-sm btn-danger delBtn" data-id="'.$row->batchType_id.'"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    } else {
                        $deleteButton = '';
                    }
                    if(Gate::allows('batchType-edit')) {
                        $viewBtn = '<a href="javascript:void(0)" class="btn btn-primary editBtn" data-id="'. $row->batchType_id . '" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a> &nbsp;';
                    } else {
                        $viewBtn ='';
                    }
                    return $viewBtn .$deleteButton;
                })
                ->rawColumns(['action', 'id'])->make(true);
        }

        return view('batch_type/batch_type');
    }

    public function store(Request $request)
    {
        if ($request->BatchTypeId != null) {
            $batchType = BatchType::find($request->BatchTypeId);

            $request->validate([
                'batch_type' => 'required|string|max:255|unique:batch_types,batchType,' . $batchType->batchType_id . ',batchType_id',
            ]);

            $batchType->update([
                'batchType' => $request->batch_type,
            ]);
            return response()->json([
                'success' => 'BatchType updated successfully',
            ], 201);
        } else {
            $request->validate([
                'batch_type' => 'required|string|max:255|unique:batch_types,batchType',
            ]);

            BatchType::create([
                'batchType' => $request->batch_type,
            ]);

            return response()->json([
                'success' => 'BatchType added successfully',
            ], 201);
        }
    }

    public function edit($id)
    {
        $batchType = BatchType::find($id);

        if(is_null($batchType)){
            return redirect()->route('batchType');
        } else {
            return $batchType;
        }
    }

    public function destroy($id)
    {
        $batchType = BatchType::find($id);

        if(is_null($batchType)){
            return redirect()->route('batchType');
        } else {
            $batchType->delete();
            return response()->json(['success' => 'BatchType deleted successfully'], 201);
        }
    }
}
