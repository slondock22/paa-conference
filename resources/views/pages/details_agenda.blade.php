@extends('layouts.app', ['title' => 'Agenda'])
@section('content')
<section>
<div class="gap2 gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row merged20" id="page-contents">
					@include('pages.banner')
					
					<div class="col-lg-12">
						<div class="tab-content">
							<div class="tab-pane active fade show" id="link1">
								<div class="row merged20">
									<div class="col-lg-7">
										<div class="central-meta">
											<div class="create-post"><i class="fa fa-circle text-danger blinker" style="vertical-align: text-top;">
						</i> Live Streaming</div>
										@if(Auth::user()->role_id != 4 )
											<iframe height="330" src="{{$agenda->agenda_presentation_url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										@else
											<div class="widget" style="min-height: 335px">
												<br>
												<br>
												<br>
												<br>
												<br>
												<br>
												<center>
													<a href="{{$agenda->agenda_zoom_url}}" class="main-btn" target="_blank">Open The Zoom App</a>
												</center>
											</div>
										@endif
										</div>	
									</div>
									<div class="col-lg-5">
										<div class="central-meta">
											<div class="create-post" style="margin-bottom: 0px !important;">Q&A Box</div>
											<div class="live-chat">
												<div class="row">
												<div class="col-lg-12 col-md-12">

													@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 3)
													<div class="mesg-area-head text-center">
														<ul class="live-calls">
															<li class="anchor-active" id="chat"><a href="#">Chat</a></li>
															<li id="question"><a href="#">Question</a></li>
															<li id="answered"><a href="#">Answered</a></li>
														</ul>
													</div>
													<div class="mesge-area" id="question_box" style="display: none;">
														<ul class="conversations" id="question_conversation">
															
														</ul>
													</div>
													<div class="mesge-area" id="answered_box" style="display: none;">
														<ul class="conversations" id="answered_conversation">
															
														</ul>
													</div>
													@endif

													<div class="mesge-area" id="chat_box">
														<ul class="conversations" id="chat_conversation">
															
														</ul>
													</div>

													@if(Auth::user()->role_id != 4 )
													<div class="message-writing-box">
														<form method="post" id="frmchat" name="frmchat">
															<div class="text-area">
																<input type="text" placeholder="write your question here.." id="chat_text_box">
																<button type="submit"><i class="fa fa-paper-plane-o"></i></button>
															</div>
														</form>
													</div>
													@endif

												</div>
												</div>
											</div>
										</div>	
									</div>
									<div class="col-lg-12">
										<div class="central-meta">
											<span class="create-post">General Info | {{$agenda->agenda_title}} - {{$agenda->agenda_subtitle}}</span>
											<div class="row">
												<div class="col-lg-6">
													<div class="gen-metabox">
														<span><i class="fa fa-puzzle-piece"></i> Description</span>
														<p>
															{{$agenda->agenda_description}}
														</p>
													</div>
													<div class="gen-metabox">
														<span><i class="fa fa-bullhorn"></i> Speakers</span>
														<p>
															@foreach($speakers as $speaker)
														
																{{ $loop->first ? '' : ', ' }}
																{{$speaker->speakers_name}} - {{$speaker->speakers_title}}
																
															@endforeach
														</p>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="gen-metabox">
														<span><i class="fa fa-map-marker"></i> Live Location</span>
														<p>
															{{$agenda->agenda_location}}
														</p>
													</div>
													<div class="gen-metabox">
														<span><i class="fa fa-clock"></i> Live Time</span>
														<p>
															{{date('H:i A', strtotime($agenda->agenda_start_at))}} - {{date('H:i A', strtotime($agenda->agenda_start_at))}}
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>	
</section>
@endsection
@push('custom-scripts')

<script type="text/javascript">
jQuery(document).ready(function($) {

	get_chat();

});

	var agenda_id = '{{$agenda_id}}';
	var user_login = '{{Auth::user()->id}}';
	var user_login_name = '{{Auth::user()->name}}';
	var role_id = '{{Auth::user()->role_id}}';



	function get_chat() {

	 	 $.ajax({
		        type: 'GET', //THIS NEEDS TO BE GET
		        url: "{{ url('get_chat') }}" + '/' + agenda_id,
		        dataType: 'json',
		        success: function (data) {
		            	console.log(data);

		        		if(data.length == 0){

		        			$('#chat_conversation').append('<li><div class="alert alert-secondary" id="no-chat" role="alert">There is no data in chat lists...</div></li>');
		        		}else{
		        			 $.each(data, function(key,val) {
					            console.log(val);
					            //time
					            var sent_time  = new Date(val.created_at).toString('hh:mm tt');

					            if(val.user_id == user_login){
					            	$('#chat_conversation').append('<li class="me"><figure><img src="https://ui-avatars.com/api/?name='+val.user_name+'" alt=""></figure><div class="text-box"><p>'+val.chat_text+'</p><span>'+sent_time+'</span></div></li>');
					            }
					            else{

					            	var pick;

					            	if(role_id == 1 || role_id == 3){
					            		pick = 'pick';
					            	}
					            	else{
					            		pick = '';
					            	}

					            	$('#chat_conversation').append('<li class="you"><figure><img src="https://ui-avatars.com/api/?name='+val.user_name+'&amp;background=random" alt=""></figure><div class="text-box '+pick+'" id="'+val.id+'"><strong>'+val.user_name+'</strong><p class="'+val.label+'">'+val.chat_text+'</p><span>'+sent_time+'</span></div></li>');
					            }

						 		$('#chat_conversation').animate({scrollTop: $('#chat_conversation').prop("scrollHeight")}, 10);

					        });
		        			
		        		}

		            	
		        },error:function(data){ 
		             console.log(data);
		        }
		    });
	}

	//Send Chat

	$('#frmchat').submit(function(event) {
		event.preventDefault();

		var chat_text = $('#chat_text_box').val();

		if(chat_text == ''){
			showNotif('Caution!','Chat box cannot be empty..','error','','');
			return false;
		}

		$('#no-chat').hide();

		 $.ajax({
		        type: 'POST', //THIS NEEDS TO BE GET
		        url: "{{ url('send_chat') }}" + '/' + agenda_id,
		        data: {chat_text:chat_text},
		        dataType: 'json',
		        success: function (data) {
		            	console.log(data);

						$('#chat_text_box').val('');
		            	
		        },error:function(data){ 
		             console.log(data);
		        }
		    });


		
	});
</script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="text/javascript">

	function loadTime() {
		 var date = new Date().toString('hh:mm tt');
		 return date;
	}

	var today;
	setInterval(function(){
	  today= loadTime();
	  console.log(today);
	}, 15000);

	 
	var user_login = '{{Auth::user()->id}}';

	Pusher.logToConsole = true;

    var pusher = new Pusher('6b105edf9879ff9958a1', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('chat-channel');
    channel.bind('chat-event', function(data) {
    	console.log(data.data.user_id);
    	// return false;
    	if(user_login == data.data.user_id){
    	
			$('#chat_conversation').append('<li class="me"><figure><img src="https://ui-avatars.com/api/?name='+data.data.user_name+'" alt=""></figure><div class="text-box"><p>'+data.data.chat_text+'</p><span>'+today+'</span></div></li>');

		}else{
			$('#chat_conversation').append('<li class="you"><figure><img src="https://ui-avatars.com/api/?name='+data.data.user_name+'&amp;background=random" alt=""></figure><div class="text-box"><strong>'+data.data.user_name+'</strong><p>'+data.data.chat_text+'</p><span>'+today+'</span></div></li>');

		}

			 $('#chat_conversation').animate({scrollTop: $('#chat_conversation').prop("scrollHeight")}, 10);

    });

  

</script>

<script type="text/javascript">

	 $('ul.live-calls li').click(function(e){ 
	 	e.stopPropagation();
    	e.stopImmediatePropagation();
    	e.preventDefault();


    	$('ul.live-calls li').removeClass('anchor-active');
    	
    	$('#chat_conversation').html('');
    	$('#question_conversation').html('');
    	$('#answered_conversation').html('');


    	var tab = $(this).attr('id');

    	if(tab == 'question'){
    		$('#chat_box').hide();
    		$('#answered_box').hide();
    		$('.message-writing-box').hide();
    		loadMarkQuestion();
    		$('#question_box').show();
    		$('#question').addClass('anchor-active');
    	}

    	if(tab == 'chat'){
    		$('#question_box').hide();
    		$('#answered_box').hide();
    		get_chat();
    		$('#chat_box').show();
    		$('.message-writing-box').show();
    		$('#chat').addClass('anchor-active');
    	}

    	if(tab == 'answered'){
    		$('#question_box').hide();
    		$('#chat_box').hide();
    		$('.message-writing-box').hide();
    		loadAnsweredChat();
    		$('#answered_box').show();
    		$('#answered').addClass('anchor-active');
    	}

     });

     $('#chat_conversation').on('click', 'li > .pick', function(event){
    	event.stopPropagation();
    	event.stopImmediatePropagation();

    	var chat_id = $(this).attr('id');
    	var text = $(this).find('p').addClass('text-primary');


    	$.ajax({
		        type: 'POST', //THIS NEEDS TO BE GET
		        url: "{{ url('mark_chat') }}",
		        data: {chat_id:chat_id},
		        dataType: 'json',
		        success: function (data) {
		            	console.log(data);

							showNotif('Success','This chat is moving to question tab','success','','top-right');

		            	
		        },error:function(data){ 
							showNotif('Success','This chat is moving to question tab','success','','top-right');

		             console.log(data);
		        }
		    });

     });

     $('#question_conversation').on('click', 'li > .pick', function(event){
    	event.stopPropagation();
    	event.stopImmediatePropagation();

    	var chat_id = $(this).attr('id');
    	var text = $(this).find('p').addClass('text-primary');

    	$(this).slideUp( 300 ).delay( 800 ).hide();


    	$.ajax({
		        type: 'POST', //THIS NEEDS TO BE GET
		        url: "{{ url('answered_chat') }}",
		        data: {chat_id:chat_id},
		        dataType: 'json',
		        success: function (data) {
		            	console.log(data);

							showNotif('Success','This chat is moving to question tab','success','','top-right');

		            	
		        },error:function(data){ 
							showNotif('Success','This chat is moving to question tab','success','','top-right');

		             console.log(data);
		        }
		    });

     });

     function loadMarkQuestion() {
     	 $.ajax({
		        type: 'GET', //THIS NEEDS TO BE GET
		        url: "{{ url('get_mark_chat') }}" + '/' + agenda_id,
		        dataType: 'json',
		        success: function (data) {
		            	console.log(data);

		        		if(data.length == 0){

		        			$('#question_conversation').append('<li><div class="alert alert-secondary" role="alert">There is no data in question lists...</div></li>');
		        		}else{
		        			 $.each(data, function(key,val) {
					            console.log(val);
					            //time
					            var sent_time  = new Date(val.created_at).toString('hh:mm tt');

					           	var pick;

					            	if(role_id == 1 || role_id == 3){
					            		pick = 'pick';
					            	}
					            	else{
					            		pick = '';
					            	}

					            	$('#question_conversation').append('<li class="you"><figure><img src="https://ui-avatars.com/api/?name='+val.user_name+'&amp;background=random" alt=""></figure><div class="text-box '+pick+'" id="'+val.id+'"><strong>'+val.user_name+'</strong><p>'+val.chat_text+'</p><span>'+sent_time+'</span></div></li>');

						 		$('#question_conversation').animate({scrollTop: $('#question_conversation').prop("scrollHeight")}, 300);

					        });
		        			
		        		}

		            	
		        },error:function(data){ 
		             console.log(data);
		        }
		    });
     }

     function loadAnsweredChat() {
     	 $.ajax({
		        type: 'GET', //THIS NEEDS TO BE GET
		        url: "{{ url('get_answered_chat') }}" + '/' + agenda_id,
		        dataType: 'json',
		        success: function (data) {
		            	console.log(data);

		        		if(data.length == 0){

		        			$('#answered_conversation').append('<li><div class="alert alert-secondary" role="alert">There is no data in answered of question lists...</div></li>');
		        		}else{
		        			 $.each(data, function(key,val) {
					            console.log(val);
					            //time
					            var sent_time  = new Date(val.created_at).toString('hh:mm tt');

					           $('#answered_conversation').append('<li class="you"><figure><img src="https://ui-avatars.com/api/?name='+val.user_name+'&amp;background=random" alt=""></figure><div class="text-box" id="'+val.id+'"><strong>'+val.user_name+'</strong><p>'+val.chat_text+'</p><span>'+sent_time+'</span></div></li>');

						 		$('#answered_conversation').animate({scrollTop: $('#answered_conversation').prop("scrollHeight")}, 300);

					        });
		        			
		        		}

		            	
		        },error:function(data){ 
		             console.log(data);
		        }
		    });
     }
</script>

@endpush



