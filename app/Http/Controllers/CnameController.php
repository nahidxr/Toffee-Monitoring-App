<?php

namespace App\Http\Controllers;

use App\Models\Cname;
use Illuminate\Http\Request;

class CnameController extends Controller
{
    public function index()
    {
         $data['cName_list'] = Cname::get();
        return view('admin.channel_name.index', $data);

    }
    public function create()
    {
        return view('admin.channel_name.create');
    }

    public function store(Request $request)
    {
        $cName = new Cname();
        $cName->name = $request->name;
        $cName->save();
        return redirect('/channel_name');
    }

    public function show(Cname $cname)
    {
        //
    }

    public function edit($id)
    {
        $cName = Cname::find($id);
        if (!$cName) {

            return redirect('/channel_name');
        }
        $data["cName"] = $cName;
        return view("admin.channel_name.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $cName = Cname::find($id);
        if (!$cName) {

            return redirect('/channel_name');
        }

        $cName->name = $request->name;
        $cName->save();
        return redirect('/channel_name');
    }
    
    public function destroy($id)
    {
        
        $cName = Cname::find($id);
        if (!$cName) {

            return redirect('/channel_name');
        }
        $cName->delete();
        return redirect("/channel_name");
    }
}
