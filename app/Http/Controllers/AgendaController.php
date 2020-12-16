<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Events\ChatEvents;

class AgendaController extends Controller
{
    public function index()
    {
    	$agenda = DB::table('tx_agenda as a')->leftjoin('tr_agenda_status as b','a.agenda_status','b.id')->where('a.event_id', '1')->
    	select('a.*','b.id as speakers_id','b.status','b.label')->get();

    	$speakers = DB::table('tx_agenda_speakers as a')->leftjoin('tx_speakers as b','a.speakers_id','b.id')->get();

    	$attendances = DB::table('tx_attendance_agenda as a')->leftjoin('users as b', 'a.user_id', 'b.id')->select('b.*','a.agenda_id')->whereNotIn('b.role_id', [1])->get();

    	$attendance_count = DB::table('tx_attendance_agenda')->selectRaw('agenda_id, count(*) as total_attendance')->groupBy('agenda_id')->get();

    	$tenants = DB::table('tx_tenants as a')->leftjoin('users as b','a.tenant_admin_id','b.id')->leftjoin('tr_country as c','a.tenant_country','c.id')->select('a.*','b.name','c.nicename')->get();

    	// dd($tenants);

    	return view('pages.agenda')->with(compact('agenda','speakers','attendances','attendance_count','tenants'));
    }

     public function agenda_details($id)
    {
    	$agenda_id = Crypt::decrypt($id);

    	//insert tabel attendance agenda;
    	$isEnter = DB::table('tx_attendance_agenda')->where('agenda_id',$agenda_id)->where('user_id',Auth::user()->id)->count();

    	if($isEnter == 0){
    		$attendance = DB::table('tx_attendance_agenda')->insert(
    						[
    							'agenda_id' => $agenda_id,
    							'user_id'	=> Auth::user()->id,
    						]);
    	}

    	//get detail agenda
    	$agenda = DB::table('tx_agenda')->where('id',$agenda_id)->first();
    	$speakers = DB::table('tx_agenda_speakers as a')->leftjoin('tx_speakers as b','a.speakers_id','b.id')->where('a.agenda_id',$agenda_id)->get();


    	return view('pages.details_agenda')->with(compact('agenda','speakers','agenda_id'));
    }

    public function get_chat($agenda_id)
    {

    	$data = DB::table('tx_chat_agenda as a')->leftjoin('users as b','a.user_id','b.id')->leftjoin('tr_chat_status as c','a.chat_status','c.id')->where('agenda_id',$agenda_id)->select('a.*','b.name as user_name','c.status','c.label')->get();
    	return response()->json($data);
    }

    public function send_chat($agenda_id, Request $request)
    {
   
    	$insert = DB::table('tx_chat_agenda')->insert([
    				'agenda_id' => $agenda_id,
    				'user_id' => Auth::user()->id,
    				'chat_text' => $request->chat_text,
    			]);

    	if($insert){
    		$new_message = array( 'chat_text' => $request->chat_text,
    						    'user_id' => Auth::user()->id,
    							'user_name' => Auth::user()->name );

    		event(new ChatEvents($new_message));

    		return response()->json('SENT',200);
    	}

    		return response()->json('ERROR',500);

    }

    public function mark_chat(Request $request)
    {
    	$chat_id = $request->chat_id;

    	$update_marked = DB::table('tx_chat_agenda')->where('id',$chat_id)->update([
    							'chat_status' => '2'
    						]);

    	if($update_marked){
    		return response()->json('SENT',200);
    	}

    		return response()->json('ERROR',500);
    }

     public function answered_chat(Request $request)
    {
        $chat_id = $request->chat_id;

        $update_answered = DB::table('tx_chat_agenda')->where('id',$chat_id)->update([
                                'chat_status' => '3'
                            ]);

        if($update_answered){
            return response()->json('SENT',200);
        }

            return response()->json('ERROR',500);
    }

    public function get_mark_chat($agenda_id)
    {

    	$data = DB::table('tx_chat_agenda as a')->leftjoin('users as b','a.user_id','b.id')->where('agenda_id',$agenda_id)->where('a.chat_status','2')->select('a.*','b.name as user_name')->get();
    	return response()->json($data);
    }

     public function get_answered_chat($agenda_id)
    {

        $data = DB::table('tx_chat_agenda as a')->leftjoin('users as b','a.user_id','b.id')->where('agenda_id',$agenda_id)->where('a.chat_status','3')->select('a.*','b.name as user_name')->get();
        return response()->json($data);
    }
}
