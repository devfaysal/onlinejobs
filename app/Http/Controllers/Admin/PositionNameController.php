<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\PositionName;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class PositionNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.positionName.index');
    }
    public function getPositionNameData()
    {
        $PositionNames = PositionName::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($PositionNames)
        ->addColumn('action', function ($PositionName) {
            $string  = '<a href="'.route('admin.positionName.edit', $PositionName->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($PositionName->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$PositionName->getTable(), $PositionName->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$PositionName->getTable(), $PositionName->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.positionName.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $PositionName = new PositionName;
        $PositionName->name = $request->name;
        $PositionName->save();

        
        Session::flash('message', 'PositionName added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.positionName.index');
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
        $PositionName = PositionName::where('id', $id)->first();
        return view('admin.positionName.edit', compact('PositionName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $PositionName = PositionName::where('id', $id)->first();
        $PositionName->name = $request->name;
        $PositionName->save();

        Session::flash('message', 'PositionName updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.positionName.index');
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
