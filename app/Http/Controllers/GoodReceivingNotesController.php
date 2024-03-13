<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodReceivingNotesController extends Controller
{
    public function index(){
        return view('materialForms/goodReceivingForm');
    }
}
