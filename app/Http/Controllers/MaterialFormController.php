<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialRecordEntry;

class MaterialFormController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('materialForms/materialEntryRecordForm');
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


}
