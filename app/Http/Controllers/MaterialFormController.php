<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialRecordEntry;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class MaterialFormController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:material-record-Entry-list|material-record-Entry-create|material-record-Entry-edit|material-record-Entry-delete', ['only' => ['index','store']]);
        $this->middleware('permission:material-record-Entry-create', ['only' => ['create','store']]);
        $this->middleware('permission:material-record-Entry-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:material-record-Entry-delete', ['only' => ['destroy']]);
    }

    public function create()
    {
        return view('materialForms.materialEntryRecordForm');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'serialNumber' => ['required', 'string', 'max:255'],
                'itemCode' => ['required', 'string','unique:material_record_entries,itemCode'],
                'itemDescription' => ['required', 'string'],
                'manufacturerName' => ['required', 'string', 'max:255'],
                'manufacturerAddress' => ['required', 'string'],
                'preparedBy' => ['required', 'string'],
                'date' => ['required', 'date'],
            ]
        );
        $materialRecordEntry = new MaterialRecordEntry;
        $materialRecordEntry->serialNumber = $request->serialNumber;
        $materialRecordEntry->itemCode = $request->itemCode;
        $materialRecordEntry->itemDescription = $request->itemDescription;
        $materialRecordEntry->manufacturerName = $request->manufacturerName;
        $materialRecordEntry->manufacturerAddress = $request->manufacturerAddress;
        $materialRecordEntry->preparedBy = $request->preparedBy;
        $materialRecordEntry->date = $request->date;
        $materialRecordEntry->remarks = $request->remarks;
        $materialRecordEntry->save();
        $message = array(
            'message' => "Material Record Entry Added Successfully.",
            'type'=> "success",
        );
        return redirect()->route('material.Entry.Record')->with($message);
    }

    public function index(Request $request){
        $materialEntryRecords = MaterialRecordEntry::get();
        if($request->ajax()){
            return DataTables::of($materialEntryRecords)->addIndexColumn()
                ->addColumn('action',  function($row) {
                    $deleteButton = '';
                    $viewButton = '';
                    $editButton = '';
                    if (Gate::allows('material-record-Entry-delete')) {
                        $deleteButton = '<button onclick="confirmDelete(\'link\', 0, \''.route('material.Entry.Record.delete', $row->material_record_id).'\')"" class="btn btn-sm btn-danger delBtn" data-id="' . $row->id . '"
                                                data-toggle="tooltip" title="delete">
                                                <i class="fa fa-times"></i>
                                            </button>';
                    }
                    if (Gate::allows('material-record-Entry-list')) {
                        $viewButton = '<button class="btn btn-sm btn-primary viewBtn" data-id="' . $row->material_record_id . '" data-sr="' . $row->serialNumber . '"
                                           data-itemcode="' . $row->itemCode . '" data-itemdescription="' . $row->itemDescription . '"
                                           data-manufacturername="' . $row->manufacturerName . '" data-manufactureraddress="' . $row->manufacturerAddress . '"
                                           data-preparedby="' . $row->preparedBy . '" data-date="' . $row->date . '" data-remarks="' . $row->remarks . '"
                                                data-toggle="tooltip" title="view">
                                                <i class="fa fa-eye"></i>
                                            </button>';
                    }

                    if (Gate::allows('material-record-Entry-edit')) {
                        $editButton = '<a href="' . route("material.Entry.Record.edit", $row->material_record_id) . '" class="btn btn-primary editBtn" data-id="'.$row->material_record_id.'" style="background: #0b2e13; border: none"> <i class="fa fa-pencil primary"></i></a>';
                    }
                    return $viewButton.' '.$editButton . ' '.$deleteButton;
                })
                ->rawColumns(['action', 'id'])->make(true);
        }

        return view('reports.material_record_entry_report');
    }

    public function edit($id)
    {
        $materialRecordEntry = MaterialRecordEntry::find($id);
        if(is_null($materialRecordEntry)){
            return redirect()->route('reports/material_record_entry_report');
        }
        else {
            $data = compact(['materialRecordEntry']);
        }
        return view('materialForms.editMaterialEntryRecordForm')->with($data);
    }

    public function update($id, Request $request)
    {
        $materialEntryRecord = MaterialRecordEntry::find($id);
        $request->validate(
           [
               'serialNumber' => ['required', 'string', 'max:255'],
               'itemCode' => 'required|string|unique:material_record_entries,itemCode,' . $materialEntryRecord->id,
               'itemDescription' => ['required', 'string'],
               'manufacturerName' => ['required', 'string', 'max:255'],
               'manufacturerAddress' => ['required', 'string'],
               'preparedBy' => ['required', 'string'],
               'date' => ['required', 'date'],
           ]
        );

        $materialEntryRecord->serialNumber = $request->serialNumber;
        $materialEntryRecord->itemCode = $request->itemCode;
        $materialEntryRecord->itemDescription = $request->itemDescription;
        $materialEntryRecord->manufacturerName = $request->manufacturerName;
        $materialEntryRecord->manufacturerAddress = $request->manufacturerAddress;
        $materialEntryRecord->preparedBy = $request->preparedBy;
        $materialEntryRecord->date = $request->date;
        $materialEntryRecord->remarks = $request->remarks;
        $materialEntryRecord->update();

        $message = array(
            'message' => "Material Entry Record Update Successfully.",
            'type'=> "success",
        );
        return redirect()->route('material.Entry.Record.Report')->with($message);

    }

    public function delete ($id){

        $materialEntryRecord = MaterialRecordEntry::find($id);
        if(!is_null($materialEntryRecord)) {
            $materialEntryRecord->delete();
        }
        $message = array(
            'message' => "Material Entry Record Delete Successfully.",
            'type'=> "success",
        );
        return redirect()->route('material.Entry.Record.Report') -> with($message);
    }

}
