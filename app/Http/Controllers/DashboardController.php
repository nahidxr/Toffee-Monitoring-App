<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cprofile;
use App\Models\NotifiedChannel;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //  $data['cprofile_list'] = Cprofile::get();
        // return view('admin.dashboard.index', $data);
     
        $data['total_profiles'] = Cprofile::count();
        $data['inactive_channels'] = Cprofile::where('status', 0)->count();

        // $data['inactiveChannelsCount'] = NotifiedChannel::where('channel_status', 'Invalid')
        //                                 ->selectRaw('count(*) as count, channel_name_id')
        //                                 ->groupBy('channel_name_id')
        //                                 ->get()
        //                                 ->count();

        $data['inactiveChannelsCount'] = NotifiedChannel::where('channel_status', 'Invalid')
                                        ->whereIn('channel_name_id', function ($query) {
                                            $query->select('channel_name_id')
                                                ->from('notified_channels')
                                                ->where('channel_status', 'Invalid')
                                                ->groupBy('channel_name_id');
                                          })
                                        ->whereIn('channel_name_id', function ($query) {
                                        $query->select('channel_name_id')
                                        ->from('cprofiles')
                                        ->where('status', 1)
                                        ->groupBy('channel_name_id');
                                        })
                                        ->selectRaw('count(*) as count, channel_name_id')
                                        ->groupBy('channel_name_id')
                                        ->get()
                                        ->count();


         // Other data or operations
        return view('admin.dashboard.index', $data);
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
