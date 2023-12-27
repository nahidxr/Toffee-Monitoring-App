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
        'ip' => 'required|unique:application_details', // Ensure IP is unique in application_details table
        'location' => 'required',
        'connection_type' => 'required',
        'owner' => 'required',
        'app_name_id' => 'required|array',
        'status' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/app_details/create')
            ->withErrors($validator)
            ->withInput();
    }

    // Check if the IP address already exists
    $existingIP = ApplicationDetails::where('ip', $request->ip)->exists();
    if ($existingIP) {
        $notification = [
            'message' => 'IP address already exists.',
            'alert-type' => 'error'
        ];
        return redirect('/app_details/create')->with($notification);
    }

    $data = new ApplicationDetails();
    $data->node_name = $request->node_name;
    $data->ip = $request->ip;
    $data->location = $request->location;
    $data->owner = $request->owner;
    $data->connection_type = $request->connection_type;
    $data->status = $request->status;

    // Save the ApplicationDetails model first to get its ID
    $data->save();

    // Sync the associated application names
    $data->applicationNames()->sync($request->app_name_id);

    $notification = [
        'message' => 'Data Inserted Successfully',
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
    
        // Get the selected App Name IDs for this ApplicationDetails entry
        $selected_app_ids = $appDetails->applicationNames()->pluck('application_names.id')->toArray();
        $data["selected_app_ids"] = $selected_app_ids;
    
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
            'app_name_id' => 'required|array', // Ensure app_name_id is an array
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/app_details/create')
                ->withErrors($validator)
                ->withInput();
        }
    
        $data->node_name = $request->node_name;
        $data->ip = $request->ip;
        $data->location = $request->location;
        $data->owner = $request->owner;
        $data->connection_type = $request->connection_type;
        $data->status = $request->status;
    
        // Save the ApplicationDetails model first to get its ID
        $data->save();
    
        // Sync the associated application names
        $data->applicationNames()->sync($request->app_name_id);
    
        $notification = [
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect('/app_details')->with($notification);
    }

    public function destroy($id)
    {
        try {
            $appDetails = ApplicationDetails::findOrFail($id);
            
            // Detach related records from the pivot table
            $appDetails->applicationNames()->detach();
            
            // Delete the ApplicationDetails record
            $appDetails->delete();
    
            return redirect("/app_details")->with('success', 'Record deleted successfully.');
        } catch (Exception $e) {
            return redirect("/app_details")->with('error', 'Cannot delete the app name due to related records.');
        }
    }
    
}