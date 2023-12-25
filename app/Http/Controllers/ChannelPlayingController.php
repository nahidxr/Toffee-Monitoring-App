<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cprofile;
use App\Models\NotifiedChannel;
use App\Models\Cname;
use Illuminate\Support\Facades\DB;



class ChannelPlayingController extends Controller
{
    public function index()
    {
        $channels = DB::table('cnames')
            ->select(
                'cnames.name AS channel_name',
                'cprofiles.image AS profile_image',
                'cprofiles.service_name AS service_name'
            )
            ->selectRaw("CASE
                WHEN 'invalid' IN (
                    SELECT notified_channels.channel_status
                    FROM cprofiles
                    JOIN notified_channels ON cprofiles.id = notified_channels.cprofile_id
                    WHERE cprofiles.channel_name_id = cnames.id
                ) THEN 'invalid'
                ELSE 'valid'
            END AS overall_channel_status")
            ->join('cprofiles', 'cnames.id', '=', 'cprofiles.channel_name_id')
            ->get();

            // dd($channels);
    
        return view('admin.channel_playing.index', compact('channels'));
    }
    
}
