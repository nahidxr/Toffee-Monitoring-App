<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationStatusController extends Controller
{
    public function index()
    {    
        return view('admin.application_status.index');
    }
}
