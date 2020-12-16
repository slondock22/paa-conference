<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AttendeesController;
use App\Http\Controllers\ReferencesController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/country',[ReferencesController::class, 'get_country'])->name('country');


Route::middleware('auth')->group(function() {

	Route::get('/',[AboutController::class, 'index']);
	Route::get('/about',[AboutController::class, 'index'])->name('about');
	Route::get('/agenda',[AgendaController::class, 'index'])->name('agenda');
	Route::get('/attendees',[AttendeesController::class, 'index'])->name('attendees');

	Route::get('/agenda-details/{id}',[AgendaController::class, 'agenda_details'])->name('agenda-details');

	Route::get('/get_chat/{agenda_id}',[AgendaController::class, 'get_chat'])->name('get_chat');
	Route::post('/send_chat/{agenda_id}',[AgendaController::class, 'send_chat'])->name('send_chat');
	Route::post('/mark_chat',[AgendaController::class, 'mark_chat'])->name('mark_chat');
	Route::get('/get_mark_chat/{agenda_id}',[AgendaController::class, 'get_mark_chat'])->name('get_mark_chat');
	Route::get('/get_answered_chat/{agenda_id}',[AgendaController::class, 'get_answered_chat'])->name('get_answered_chat');
	Route::post('/answered_chat',[AgendaController::class, 'answered_chat'])->name('answered_chat');








	Route::get('/event_details', [AboutController::class, 'event_details'])->name('event_details');





	Route::redirect('/home', '/', 301);

});


