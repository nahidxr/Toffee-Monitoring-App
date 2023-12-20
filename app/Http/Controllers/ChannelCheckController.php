<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cprofile;
use Illuminate\Support\Facades\Http;


class ChannelCheckController extends Controller
{
   
    public function index()
    {
        $data['cprofile_list'] = Cprofile::where('status', 1)->get();
        // dd($data);
        return view('admin.channel_checking.index', $data);
    }

    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
