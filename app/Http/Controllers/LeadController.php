<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogbookRecord;
use App\Http\Requests\LeadAddRequest;

class LeadController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(LeadAddRequest $request)
    {
        $logbookRecord = new LogbookRecord;
        $logbookRecord->first_name = $request->input('first_name');
        $logbookRecord->last_name = $request->input('last_name');
        $logbookRecord->email = $request->input('email');
        $logbookRecord->telephone = $request->input('telephone');
        $logbookRecord->privacy = $request->input('privacy');
        $logbookRecord->privacy_marketing = $request->input('privacy_marketing');
        $logbookRecord->privacy_third_party = $request->input('privacy_third_party');
        $logbookRecord->campaign_id = $request->input('campaign_id');
        $logbookRecord->save();
        
        return response()->json(['success' => 'Lead succesfully inserted'], 200);
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

    /**
     * Return a random lead
     *
     * @return void
     */
    public function random()
    {
        return LogbookRecord::inRandomOrder()->first();
    }
}
