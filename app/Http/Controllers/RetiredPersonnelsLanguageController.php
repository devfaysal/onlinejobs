<?php

namespace App\Http\Controllers;

use Session;
use App\Language;
use Illuminate\Http\Request;
use App\RetiredPersonnelsLanguage;

class RetiredPersonnelsLanguageController extends Controller
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
        $languages = Language::where('status', 1)->get();
        return view('retired.addLanguage', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        if($request->language && $request->language[0] != null){
            for($i=0; $i< count($request->language); $i++){
                $language = new RetiredPersonnelsLanguage;
                $language->user_id = auth()->id();
                $language->language = $request->language[$i];
                $language->speaking = $request->speaking[$i];
                $language->writing = $request->writing[$i];
                $language->save();
            }
        }

        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('retiredPersonnel.index');
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
