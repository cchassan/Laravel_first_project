<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialFormController extends Controller
{
    public function index()
    {
        return view('materialForms/materialEntryRecordForm');
    }
}
