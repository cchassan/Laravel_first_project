<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MaterialRecordEntry;
use Illuminate\Http\Request;

class MaterialReceivingFormController extends Controller
{
    public function index(){
        $locations = Location::get();
        return view('materialForms.materialReceivingForm')->with(compact('locations'));
    }


    public function getItemCodes(Request $request)
    {
        $query = $request->input('query');

        // Retrieve item codes based on user input
        $itemCodes = MaterialRecordEntry::where('itemCode', 'like', "%$query%")->get();
        return response()->json($itemCodes);
    }
}
