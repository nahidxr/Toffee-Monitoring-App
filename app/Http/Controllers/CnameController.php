<?php

namespace App\Http\Controllers;

use App\Models\Cname;
use Illuminate\Http\Request;

class CnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['cName_list'] = Cname::get();
        return view('admin.channel_name.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.channel_name.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cName = new Cname();
        $cName->name = $request->name;
        $cName->save();
        return redirect('/channel_name');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cname  $cname
     * @return \Illuminate\Http\Response
     */
    public function show(Cname $cname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cname  $cname
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cName = Cname::find($id);
        if (!$cName) {

            return redirect('/channel_name');
        }
        $data["cName"] = $cName;
        return view("admin.channel_name.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cname  $cname
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cname  $cname
     * @return \Illuminate\Http\Response
     */
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
