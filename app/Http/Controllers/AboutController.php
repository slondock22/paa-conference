<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AboutController extends Controller
{
   
   public function index()
   {
   	 return view('pages.about');
   }

   public function event_details()
   {
   	 $data = DB::table('mt_event')->where('id','1')->first();

   	 return response()->json($data);
   }
}
