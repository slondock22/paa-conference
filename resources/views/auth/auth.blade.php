@extends('layouts.app')
@section('content')
<div class="www-layout">
    <section>
        <div class="gap no-gap signin whitish medium-opacity">
            <div class="bg-image" style="background-image:url(assets/images/resources/bg.jpg)"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="big-ad">
                            <figure><img src="{{asset('assets')}}/images/paa_logo.png" alt=""></figure>
                            <h1 style="color: #0072ba;">ONLINE CONFFERENCE 2020</h1>
                            <hr style="width:100px; border-color:#0072ba; float: left; ">

                            <p>
                                 PAA - Online Confference Event is officially hosted by the PAA and all of its ecosystem members. Showcasing the technology and digital asset industry for local and international attendees.  
                
                            </p>
                            <h5>Keynote Speakers</h5>
                            <hr style="width:100px; border-color:#c1bfbf; float: left; ">
                            
                            <div class="fun-fact">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <div class="fun-box">
                                           <img src="{{asset('assets')}}/images/resources/friend-avatar9.jpg" alt="" style="border: 2px solid #ddd; border-radius: 100%;">
                                            <h6>Ir. Joko Widi</h6>
                                            <span>Chairman of Indonesia</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <div class="fun-box">
                                            <img src="{{asset('assets')}}/images/resources/friend-avatar15.jpg" alt="" style="border: 2px solid #ddd; border-radius: 100%;">
                                            <h6>Sugeng Msc, MBA.</h6>
                                            <span>CEO of Gojek</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <div class="fun-box">
                                            <img src="{{asset('assets')}}/images/resources/friend-avatar10.jpg" alt="" style="border: 2px solid #ddd; border-radius: 100%;">
                                            <h6>Yanu AR ,Phd.</h6>
                                            <span>PAA Administrator</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   @yield('formauth')
                    
                </div>
            </div>
        </div>
    </section>
     
</div>
@endsection