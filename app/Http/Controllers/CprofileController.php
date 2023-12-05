<?php

namespace App\Http\Controllers;

use App\Enums\ChannelStatus;
use App\Models\Cname;
use App\Models\Cprofile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CprofileController extends Controller
{
 
    public function index()
    {
        $data['cprofile_list'] = Cprofile::get();
        return view('admin.channel_profile.index', $data);
    }

    public function create()
    {
        $data["channel_status"] = ChannelStatus::asSelectArray();
        $data["channel_list"] = Cname::get();
        $data["channel_profile_list"] = Cprofile::get();
        return view('admin.channel_profile.create',$data);

    }

    public function store(Request $request)
    {
        $data = new Cprofile();
        $data->Profile_name = $request->pname;
        $data->channel_name_id = $request->channel_name_id;
        $data->Profile_link = $request->plink;
        $data->status = $request->status;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/images', $filename);
            $data->image = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Image Inserted Successfully',
            'alert-type' => 'success'

        );

        return redirect('/channel_profile')->with($notification);
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
        $data["channel_name_list"] = Cname::get();

        return view("admin.channel_profile.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $data = Cprofile::find($id);
        if (!$data) {

            return redirect('/channel_profile');
        }
        $data->Profile_name = $request->pname;
        $data->channel_name_id = $request->channel_name_id;
        $data->Profile_link = $request->plink;
        $data->status = $request->status;

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

        $notification = array(
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect('/channel_profile')->with($notification);
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
