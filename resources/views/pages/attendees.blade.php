@extends('layouts.app', ['title' => 'Attendees'])
@section('content')
<section>
	<div class="gap2 gray-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row merged20" id="page-contents">
						@include('pages.banner')
						
						<div class="col-lg-12">
							<div class="central-meta">
								<div class="title-block">
									<div class="row">
										<div class="col-lg-6">
											<div class="align-left">
												<h5>Total Participant on This Event <span>{{count($attendees)}}</span></h5>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row merged20">
												<div class="col-lg-7 col-md-7 col-sm-7">
													<form method="post">
														<input type="text" placeholder="Search Friend">
														<button type="submit"><i class="fa fa-search"></i></button>
													</form>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4">
													<div class="select-options">
														<select class="select">
															<option>Sort by</option>
															<option>A to Z</option>
															<option>See All</option>
															<option>Newest</option>
															<option>oldest</option>
														</select>
													</div>
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
									</div>
								</div>
							</div><!-- title block -->
							<div class="row merged20">
								@foreach($attendees as $value)
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="friend-block">
										<!-- div class="more-opotnz">
											<i class="fa fa-ellipsis-h"></i>
											<ul>
												<li><a href="#" title="">Block</a></li>
												<li><a href="#" title="">UnBlock</a></li>
												<li><a href="#" title="">Mute Notifications</a></li>
												<li><a href="#" title="">hide from friend list</a></li>
											</ul>
										</div> -->
										<figure>
											<img src="https://ui-avatars.com/api/?name={{$value->name}}&size=64&background=random" alt="">  
										</figure>

										<div class="frnd-meta">
											<div class="frnd-name">
												<a href="#" title="">{{$value->name}}</a>
												<span>{{$value->nicename}}, {{$value->iso}}</span>
											</div>
											<!-- <a class="send-mesg" href="#" title="">Message</a> -->
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<!-- <div class="lodmore">
								<span>Viewing 1-16 of 99 friends</span>
								<button class="btn-view btn-load-more"></button>
							</div> -->
						</div><!-- centerl meta -->
					</div>	
				</div>
			</div>
		</div>
	</div>	
</section><!-- content -->
@endsection
	