<?php

namespace App\Http\Controllers;

use App\Models\Cprofile;
use Illuminate\Http\Request;

class CprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['cProfile_list'] = Cprofile::get();
        // return view('admin.channel_profile.index', $data);

        return view('admin.channel_profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.channel_profile.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Cprofile();
        $data->Profile_name = $request->pname;
        $data->channel_name_id = $request->cname;
        $data->Profile_link = $request->plink;
        $data->status = $request->pstatus;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/images', $filename);
            $data->image = $filename;
        }
        $data->save();

        return redirect('/channel_profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cprofile  $cprofile
     * @return \Illuminate\Http\Response
     */
    public function show(Cprofile $cprofile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cprofile  $cprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(Cprofile $cprofile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cprofile  $cprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cprofile $cprofile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cprofile  $cprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cprofile $cprofile)
    {
        //
    }
}
