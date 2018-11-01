<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function publish($table, $id)
    {
        DB::table($table)
            ->where('id', $id)
            ->update(['status' => 1]);

        Session::flash('message', ' Activated!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }

    public function unpublish($table, $id)
    {
        DB::table($table)
            ->where('id', $id)
            ->update(['status' => 0]);

        Session::flash('message', ' Inactivated!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }
}
