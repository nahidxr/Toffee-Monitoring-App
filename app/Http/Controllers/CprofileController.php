<?php

namespace App\Http\Controllers;

use App\Enums\ChannelStatus;
use App\Enums\Service;
use App\Models\Cname;
use App\Models\Cprofile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;



class CprofileController extends Controller
{
 
    // public function index()
    // {
    //     $data['cprofile_list'] = Cprofile::get();
    //     return view('admin.channel_profile.index', $data);
    // }
    public function index()
    {
        // Fetch all records from the cprofiles table
        $cprofile_list = Cprofile::get();
    
        // Iterate through each Cprofile record and explode the transcoder_info string into an array of links
        foreach ($cprofile_list as $cprofile) {
            // Explode the transcoder_info string based on the appropriate delimiter
            $cprofile->transcoderLinks = explode(',', $cprofile->transcoder_info);
        }
    
        // Pass the modified data to the view
        return view('admin.channel_profile.index', ['cprofile_list' => $cprofile_list]);
    }

    public function create()
    {
        $data["channel_status"] = ChannelStatus::asSelectArray();
        $data["service_name"] = Service::asSelectArray();
        $data["channel_list"] = Cname::get();
        $data["channel_profile_list"] = Cprofile::get();
        return view('admin.channel_profile.create',$data);

    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'pname' => 'required',
    //         'channel_name_id' => 'required',
    //         'plink' => 'required',
    //         'status' => 'required',
    //         'service_name' => 'required',
    //         'transcoder_info' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect('/channel_profile/create')
    //                     ->withErrors($validator)
    //                     ->withInput();
    //     }
    
    //     $data = new Cprofile();
    //     $data->Profile_name = $request->pname;
    //     $data->channel_name_id = $request->channel_name_id;
    //     $data->Profile_link = $request->plink;
    //     $data->status = $request->status;
    //     $data->service_name = $request->service_name;
    //     // $data->transcoder_info = $request->transcoder_info;
    //     $data->transcoder_info = implode(', ', $request->transcoder_info);

        
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $file->move('upload/images', $filename);
    //         $data->image = $filename;
    //     }
    
    //     $data->save();
    //     $notification = [
    //         'message' => 'Image Inserted Successfully',
    //         'alert-type' => 'success'
    //     ];
    
    //     return redirect('/channel_profile/create')->with($notification);
    // }
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'pname' => 'required',
        'channel_name_id' => 'required',
        'plink' => 'required',
        'status' => 'required',
        'service_name' => 'required',
        'transcoder_info' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
    ]);

    if ($validator->fails()) {
        return redirect('/channel_profile/create')
                    ->withErrors($validator)
                    ->withInput();
    }

    // Check if the Profile_name already exists in the database
    $existingProfile = Cprofile::where('Profile_name', $request->pname)->first();

    if ($existingProfile) {
        // Profile name already exists, you can handle this scenario as needed
        $notification = [
            'message' => 'Profile name already exists!',
            'alert-type' => 'error'
        ];

        return redirect('/channel_profile/create')->with($notification);
    }

    $data = new Cprofile();
    $data->Profile_name = $request->pname;
    $data->channel_name_id = $request->channel_name_id;
    $data->Profile_link = $request->plink;
    $data->status = $request->status;
    $data->service_name = $request->service_name;
    $data->transcoder_info = implode(', ', $request->transcoder_info);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('upload/images', $filename);
        $data->image = $filename;
    }

    $data->save();
    $notification = [
        'message' => 'Image Inserted Successfully',
        'alert-type' => 'success'
    ];

    return redirect('/channel_profile/create')->with($notification);
}


  
    public function show(Cprofile $cprofile)
    {
        //
    }

    public function edit($id)
    {
        $cProfile = Cprofile::find($id);
        if (!$cProfile) {

            return redirect('/channel_profile');
        }
        $data["channel_profile_list"] = $cProfile;
        $data["channel_status"] = ChannelStatus::asSelectArray();
        $data["service_name_list"] = Service::asSelectArray();
        $data["channel_name_list"] = Cname::get();

        return view("admin.channel_profile.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $data = Cprofile::find($id);
        if (!$data) {
            return redirect('/channel_profile');
        }
    
        $validator = Validator::make($request->all(), [
            'pname' => 'required',
            'channel_name_id' => 'required',
            'plink' => 'required',
            'status' => 'required',
            'service_name' => 'required',
            'transcoder_info' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
    
        // Update data fields
        $data->Profile_name = $request->pname;
        $data->channel_name_id = $request->channel_name_id;
        $data->Profile_link = $request->plink;
        $data->status = $request->status;
        $data->service_name = $request->service_name;
        // $data->transcoder_info = $request->transcoder_info;
        $data->transcoder_info = implode(', ', $request->transcoder_info);

    
        // Handle image update
        if ($request->hasFile('image')) {
            $destination = 'upload/images/' . $data->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/images', $filename);
            $data->image = $filename;
        }
    
        $data->save();
    
        $notification = [
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect('/channel_profile/create')->with($notification);
    }

    public function destroy($id)
    {
        try {
            $cProfile = Cprofile::findOrFail($id);
            $cProfile->delete();
            return redirect("/channel_profile")->with('success', 'Channel profile deleted successfully.');
        } catch (QueryException $e) {
            return redirect("/channel_profile")->with('error', 'Cannot delete the channel due to related records.');
        }
    }
}
