<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialReceivingFormController extends Controller
{
    public function index(){
        return view('materialForms/materialReceivingForm');
    }
}
