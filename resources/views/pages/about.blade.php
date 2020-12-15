@extends('layouts.app', ['title' => 'About'])
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
											<div class="create-post">Information</div>
											<iframe id="event_poster_url" height="330" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										</div>	
									</div>
									<div class="col-lg-5">
										<div class="central-meta">
											<div class="create-post">About Event</div>
											<div class="about-chnl">
												<ul id="event_details">
													
												</ul>
												<span>Contribute us to improve our event for next year</span>
												<a href="#" title="" class="main-btn" data-ripple=""><i class="fa fa-heart"></i> Contribute Us</a>
											</div>
										</div>	
									</div>
									<div class="col-lg-12">
										<div class="central-meta">
											<span class="create-post">Keynote Speakers</span>
											<ul class="contributorz">
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo1.jpg" alt="">
													<span>Jhon Doe</span>
													<p>Ceo Abc.inc, Canada</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo2.jpg" alt="">
													<span>Barak Obama</span>
													<p>Ceo A to Z Cars, USA</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo3.jpg" alt="">
													<span>tayab ahmed</span>
													<p>Ceo Abc.inc, Turky</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo4.jpg" alt="">
													<span>Moosa ismial</span>
													<p>Ceo infotech ltd, Malaysia</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo5.jpg" alt="">
													<span>Mohammad bin saad</span>
													<p>HOD, Alfutim Group, Dubai</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo6.jpg" alt="">
													<span>Salhe Ibhrahim</span>
													<p>Ceo alwasita LLC, Saudia</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo7.jpg" alt="">
													<span>Xong hing</span>
													<p>Partner Xing xang Ltd, China</p>
												</li>
												<li>
													<img src="{{asset('assets')}}/images/resources/ceo8.jpg" alt="">
													<span>Frank Bob</span>
													<p>Head, Mozilla inc, UK</p>
												</li>
											</ul>
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

	 $.ajax({
	        type: 'GET', //THIS NEEDS TO BE GET
	        url: '{{route('event_details')}}',
	        dataType: 'json',
	        success: function (data) {

	            	console.log(data);

	            	$('#event_poster_url').attr('src', data.event_poster_url);

	        		var date_text  = new Date(data.event_date).toString('MMMM dd, yyyy');

	            	$("#event_details").html('');
	            	$("#event_details").append('<li><span>Event Name:</span> '+data.event_name+'</li>');
	            	$("#event_details").append('<li><span>Category:</span> '+data.event_category+'</li>');
	            	$("#event_details").append('<li><span>Located:</span> '+data.event_location+'</li>');
	            	$("#event_details").append('<li><span>Date:</span> '+date_text+'</li>');
	            	$("#event_details").append('<li><span>Time:</span> '+data.event_time+' (GMT: +7)</li>');
	            	$("#event_details").append('<li><span>Invitation:</span> '+data.event_invitation_total+' Peoples</li>');
	        },error:function(data){ 
	             console.log(data);
	        }
	    });

	});
</script>

@endpush


