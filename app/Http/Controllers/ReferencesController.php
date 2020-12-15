<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReferencesController extends Controller
{
    public function get_country()
    {
    	$data = DB::table('tr_country')->get();

    	return response()->json($data);
    }
}
