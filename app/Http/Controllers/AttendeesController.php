<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AttendeesController extends Controller
{
    public function index()
    {
    	$attendees = DB::table('users as a')->leftjoin('tr_country as b', 'a.country_id', 'b.id')->select('a.*','b.iso','b.nicename')->whereNotIn('role_id', [1])->get();
    	return view('pages.attendees')->with(compact('attendees'));
    }

    public function list($search='', $order='')
    {
   		
    }
}
