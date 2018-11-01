<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Downloads;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DownloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.downloads.index');
    }
    public function getDownloadsData()
    {
        $downloadRecords = Downloads::select(['id', 'title', 'file_name', 'user_type', 'comments', 'status'])->get();
        return DataTables::of($downloadRecords)
        ->addColumn('action', function ($downloads) {
            $string  = '<a href="'.route('admin.downloads.edit', $downloads->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if ($downloads->status == 0) {
                $string .= ' <a href="'.route('admin.publish', [$downloads->getTable(), $downloads->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            } else {
                $string .= ' <a href="'.route('admin.unpublish', [$downloads->getTable(), $downloads->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.downloads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $downloads = new downloads;
        $downloads->name = $request->name;
        $downloads->save();

        
        Session::flash('message', 'downloads added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.downloads.index');
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
    public function edit(Downloads $downloads)
    {
        return view('admin.downloads.edit', compact('downloads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Downloads $downloads, Request $request)
    {
        $downloads->name = $request->name;
        $downloads->save();

        Session::flash('message', 'downloads updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.downloads.index');
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
