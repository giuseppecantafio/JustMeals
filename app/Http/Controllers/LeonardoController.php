<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeonardoController extends Controller
{
    public function index(){
        return view('admin.leonardo.index');
    }
}
