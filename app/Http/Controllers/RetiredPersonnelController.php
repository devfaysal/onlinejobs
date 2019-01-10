<?php

namespace App\Http\Controllers;

use App\Country;
use App\RetiredPersonnel;
use Illuminate\Http\Request;

class RetiredPersonnelController extends Controller
{
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
        $countrys = Country::where('status', 1)->get();
        return view('retired.create', compact('countrys'));
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
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function show(RetiredPersonnel $retiredPersonnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function edit(RetiredPersonnel $retiredPersonnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RetiredPersonnel $retiredPersonnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetiredPersonnel $retiredPersonnel)
    {
        //
    }
}
