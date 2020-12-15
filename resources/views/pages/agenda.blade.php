@extends('layouts.app', ['title' => 'Agenda'])
@section('content')
<section>
	<div class="gap2 gray-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row merged20" id="page-contents"><!-- page-content id is used for static widget parent -->
						@include('pages.banner')
						
						<div class="col-lg-12">
							<div class="central-meta">
								<div class="title-block">
									<div class="row">
										<div class="col-lg-5 col-md-5 col-sm-5">
											<div class="align-left">
												<h5>Todays Agenda <span>{{count($agenda)}}</span></h5>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<form method="post">
												<input type="text" placeholder="Search..">
												<button type="submit"><i class="fa fa-search"></i></button>
											</form>
										</div>
										<div class="col-lg-1 col-md-1 col-sm-1">
											<div class="option-list">
												<i class="fa fa-ellipsis-v"></i>
												<ul>
													<li><a title="" href="#">Show Friends Public</a></li>
													<li><a title="" href="#">Show Friends Private</a></li>
													<li><a title="" href="#">Mute Notifications</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div><!-- title block -->
							<div class="central-meta">
								@foreach($agenda as $agenda)
								<div class="event-invites">
									<div class="row">
										<div class="col-lg-5 col-md-6 col-sm-12">
											<div class="invite-figure">
												<figure><img src="{{$agenda->agenda_image_path}}" alt=""></figure>
												<h6><a class="invitor" href="#" title="">{{$agenda->agenda_title}}</a> - <a href="#" title="">{{$agenda->agenda_subtitle}}</a></h6>
												<p>
													{{Str::limit($agenda->agenda_description, 140, '...')}}
												</p>
												<p>Speakers :
												@foreach($speakers as $speaker)
													@if($agenda->id == $speaker->agenda_id)
														{{ $loop->first ? '' : ', ' }}
														{{$speaker->speakers_name}} - {{$speaker->speakers_title}}
													@endif
												@endforeach
												</p>
											</div>
										</div>
										<div class="col-lg-5 col-md-4 col-sm-12">
											<div class="invite-location">
												<i class="ti-location-pin"></i>
												<span>{{$agenda->agenda_location}}</span>
												<span class="datentime">{{date('H:i A', strtotime($agenda->agenda_start_at))}} - {{date('H:i A', strtotime($agenda->agenda_start_at))}}</span>
												<div class="users-thumb-list">
													@foreach($attendances as $key => $attendance)
														@if($agenda->id == $attendance->agenda_id)
															@if($key < 5)
															<a data-toggle="tooltip" title="{{$attendance->name}}" href="#">
																<img src="https://ui-avatars.com/api/?name={{$attendance->name}}&size=32&background=random" alt="">  
															</a>
															@endif
														@endif
													@endforeach

													@foreach($attendance_count as $attcount)
														@if($attcount->agenda_id == $agenda->id)
															@if($attcount->total_attendance > 5)
																@php 
																	$total = 0;
																	$total = $attcount->total_attendance - 1; 
																@endphp
																<span class="more-friendz">{{$total}}+</span>
															@endif
														@endif
													@endforeach
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-2 col-sm-12">
											<div class="invites-btns">
												<a class="{{$agenda->label}}" href="{{$agenda->speakers_id == 2 ? url('/agenda-details/'.Crypt::encrypt($agenda->id)) : '#' }}" title="" data-ripple="">{{$agenda->status}}</a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="central-meta">
								<span class="create-post">Virtual Expo <a href="#" title=""></a></span>
								<ul class="suggested-frnd-caro">
									@foreach($tenants as $tenant)
									<li>
										<img src="{{asset('assets')}}{{$tenant->tenant_image_path}}" alt="">
										<div class="sugtd-frnd-meta">
											<a href="#" title="">{{$tenant->tenant_title}}</a>
											<span>{{$tenant->nicename}}</span>
											<ul class="add-remove-frnd">
												<li><a class="main-btn" href="#" onclick="openZoom('{{$tenant->tenant_meeting_id}}','{{$tenant->tenant_meeting_password}}','{{$tenant->tenant_admin_id}}')">Visit</a></li>
							
											</ul>
										</div>
									</li>
									@endforeach
								</ul>
							</div><!-- top rated developers -->
							<!-- <div class="auto-load">
								<div class="wave">
									<span class="dot"></span>
									<span class="dot"></span>
									<span class="dot"></span>
								</div>
							</div> -->
						</div><!-- centerl meta -->
					</div>	
				</div>
			</div>
		</div>
	</div>	
</section><!-- content -->
@endsection

@push('custom-scripts')

<script type="text/javascript">

 function openZoom(meeting_id,meeting_pwd,tenant_admin_id) {

 		if(meeting_id == ''){
			showNotif('Caution!','The meeting room is not prepared..','error','','');
			return false;
		}

 		var user_login = '{{Auth::user()->id}}';
 		var user_email = '{{Auth::user()->email}}';
 		var user_name = '{{Auth::user()->name}}';

 		var zoom_role;
 		var zoom_meeting_id;
 		var zoom_pwd;

 		var meeting_region = 0;
 		var meeting_lang = "en-US";

 		if(user_login == tenant_admin_id){
 			zoom_role = 1;
 		}else{
 			zoom_role = 0;
 		}

 		var formData = {
						    userName: user_name,
						    meetingNumber: meeting_id,
						    meetingPassword: meeting_pwd,
						    email: user_email,
						    role: zoom_role,
						    meetingRegion: meeting_region,
						    meetingLang: meeting_lang
						};

 	console.log(formData);

		 $.ajax({
		        type: 'POST', 
		        url: 'http://localhost:3000/join-zoom',
		        contentType: 'application/json',
		        data: JSON.stringify(formData),
		        dataType: 'json',
		        success: function (data) {

		            	console.log(data);

		            	window.location.replace(data.message.uri);

		        },error:function(e){ 
		             console.log(e);
		        },
		    });
	 	}
</script>

@endpush