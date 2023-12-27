<?php

namespace App\Http\Controllers;

use App\Models\ApplicationName;
use Illuminate\Database\QueryException;
use App\Enums\ApplicationStatus;
use Illuminate\Http\Request;

class ApplicationNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['appNameList'] = ApplicationName::get();
        return view('admin.application_name.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["app_status"] = ApplicationStatus::asSelectArray();
        return view('admin.application_name.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aName = new ApplicationName();
        $aName->name = $request->name;
        $aName->status = $request->status;

        $aName->save();
        return redirect('/app_name');


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',  
        ]);
    
        if ($validator->fails()) {
            return redirect('/app_name/create')
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aName = ApplicationName::find($id);
        if (!$aName) {

            return redirect('/app_name');
        }
        $data["aName"] = $aName;
        $data["app_status"] = ApplicationStatus::asSelectArray();


        return view("admin.application_name.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $aName = ApplicationName::find($id);
        if(!$aName){
            return redirect('/app_name');

        }
        $aName->name = $request->name;
        $aName->status = $request->status;

        $aName->save();
        return redirect('/app_name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $aName = ApplicationName::findOrFail($id);
    
            // Detach related records from the pivot table
            $aName->applicationDetails()->detach();
    
            // Delete the ApplicationName record
            $aName->delete();
    
            return redirect("/app_name")->with('success', 'Record deleted successfully.');
        } catch (QueryException $e) {
            return redirect("/app_name")->with('error', 'Cannot delete the channel due to related records.');
        }
    }
}
