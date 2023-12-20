<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cprofile;

class ChannelPlayingController extends Controller
{
    public function index()
    {

        $data['cprofile_list'] = Cprofile::get();
        return view('admin.channel_playing.index', $data);
    }
}
