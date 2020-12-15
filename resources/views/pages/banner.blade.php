<div class="user-profile">
	<figure>
		<div class="edit-pp">
			<label class="fileContainer">
				<i class="fa fa-camera"></i>
				<input type="file">
			</label>
		</div>
		<img src="{{asset('assets')}}/images/resources/banner-paa.jpg" alt="">
		<!-- <ul class="profile-controls">
			<li><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></li>
			<li><a href="#" title="Follow" data-toggle="tooltip"><i class="fa fa-star"></i></a></li>
			<li><a class="send-mesg" href="#" title="Send Message" data-toggle="tooltip"><i class="fa fa-comment"></i></a></li>
			<li>
				<div class="edit-seting" title="Edit Profile image"><i class="fa fa-sliders"></i>
					<ul class="more-dropdown">
						<li><a href="setting.html" title="">Update Profile Photo</a></li>
						<li><a href="setting.html" title="">Update Header Photo</a></li>
						<li><a href="setting.html" title="">Account Settings</a></li>
						<li><a href="support-and-help.html" title="">Find Support</a></li>
						<li><a href="#" title="">Block Profile</a></li>
					</ul>
				</div>
			</li>
		</ul> -->
	</figure>
	
	<div class="profile-section">
		<div class="row">
			<div class="col-lg-2">
				<div class="profile-author">
					<div class="profile-author-thumb">
						<img alt="author" src="{{asset('assets')}}/images/resources/channel-paa.jpg">
						<div class="edit-dp">
							<label class="fileContainer">
								<i class="fa fa-camera"></i>
								<input type="file">
							</label>
						</div>
					</div>
					<div class="author-content">
						<a class="h4 author-name" href="02-ProfilePage.html">PAA.net</a>
						<div class="country">Kwai Chung, Hongkong</div>
					</div>
				</div>
			</div>
			<div class="col-lg-10 col-md-9">
				<ul class="nav nav-tabs links-tab">
					 <li class="nav-item"><a class="" href="{{route('about')}}">About</a></li>
					 <li class="nav-item"><a class="" href="{{route('agenda')}}">Agenda</a></li>
					 <li class="nav-item"><a class="" href="{{route('attendees')}}">Attendees</a></li>
					 <li class="nav-item"><a class="" href="#link4">References</a></li>
				<!-- 	 <li class="nav-item"><a class="" href="#link5">Recorded</a></li>
					<li class="nav-item"><a class="" href="#link6">E-Certificate</a></li> -->
				</ul>
			</div>
		</div>
	</div>	
</div><!-- user profile banner  -->