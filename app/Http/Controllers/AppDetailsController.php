<?php

namespace App\Http\Controllers;
use App\Models\ApplicationDetails;
use App\Models\ApplicationName;
use Illuminate\Http\Request;
use App\Enums\AppDetails;
use App\Enums\Location;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;



class AppDetailsController extends Controller
{
    public function index()
    {
        $data['appDetails_list'] = ApplicationDetails::get();
    
    
        // Pass the modified data to the view
        return view('admin.application_details.index', $data);
    }

    public function create()
    {
        $data["app_list"] = ApplicationName::get();
        $data["location_list"] = Location::asSelectArray();
        $data["app_details"] = AppDetails::asSelectArray();
        return view('admin.application_details.create',$data);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'node_name' => 'required',
            'ip' => 'required',
            'location' => 'required',
            'connection_type' => 'required',
            'owner' => 'required',
            'app_name_id' => 'required',
            'status' => 'required',

        ]);
    
        if ($validator->fails()) {
            return redirect('/app_details/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = new ApplicationDetails();
        $data->node_name = $request->node_name;
        $data->ip = $request->ip;
        $data->location = $request->location;
        $data->owner = $request->owner;
        $data->connection_type = $request->connection_type;
        $data->status = $request->status;
        $data->app_name_id = $request->app_name_id;

        $data->save();

        $notification = [
            'message' => 'Image Inserted Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect('/app_details/create')->with($notification);
    }

  
    public function show(Cprofile $cprofile)
    {
        //
    }

    public function edit($id)
    {
        $appDetails = ApplicationDetails::find($id);
        if (!$appDetails) {

            return redirect('/app_details');
        }

        $data["location_list"] = Location::asSelectArray();
        $data["app_details"] = AppDetails::asSelectArray();
        $data['app_details_list'] = $appDetails;
        $data["app_list"] = ApplicationName::get();

        return view("admin.application_details.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $data = ApplicationDetails::find($id);
        if (!$data) {
            return redirect('/app_details');
        }
    
        $validator = Validator::make($request->all(), [
            'node_name' => 'required',
            'ip' => 'required',
            'location' => 'required',
            'connection_type' => 'required',
            'owner' => 'required',
            'app_name_id' => 'required',
            'status' => 'required',

        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
      
        // $data = new ApplicationDetails();
        $data->node_name = $request->node_name;
        $data->ip = $request->ip;
        $data->location = $request->location;
        $data->owner = $request->owner;
        $data->connection_type = $request->connection_type;
        $data->status = $request->status;
        $data->app_name_id = $request->app_name_id;

        $data->save();

        $notification = [
            'message' => 'Image Inserted Successfully',
            'alert-type' => 'success'
        ];
    
    
        return redirect('/app_details')->with($notification);
    }

    public function destroy($id)
    {
        try {
            $appDetails = ApplicationDetails::findOrFail($id);
            $appDetails->delete();
            return redirect("/app_details")->with('success', 'Channel profile deleted successfully.');
        } catch (QueryException $e) {
            return redirect("/app_details")->with('error', 'Cannot delete the channel due to related records.');
        }
    }

}