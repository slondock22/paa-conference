 @extends('auth.auth', ['title' => 'Register'])
 @section('formauth')
 <div class="col-lg-4">
    <div class="we-login-register">
        <div class="form-title">
            <i class="fa fa-key"></i>Sign Up
            <span>Sign Up now and join with awesome event around the world.</span>
        </div>
        <form class="we-form" method="post" action="{{ route('register') }}" id="register-form">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name">
            @error('name')
                <div class="caution-error">
                    {{ $message }}
                </div class="caution-error">    
            @enderror

           <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
            @error('email')
                <div class="caution-error">
                    {{ $message }}
                </div class="caution-error">    
            @enderror
            
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
                <div class="caution-error">
                    {{ $message }}
                </div class="caution-error">    
            @enderror

            <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Password">

            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number">
            @error('phone_number')
                <div class="caution-error">
                    {{ $message }}
                </div class="caution-error">    
            @enderror

            <select class="form-control @error('country') is-invalid @enderror" name="country" id="country"> 

            </select>
            @error('country')
                <div class="caution-error">
                    {{ $message }}
                </div class="caution-error">    
            @enderror

            <input type="checkbox" name="terms" id="terms" class="@error('terms') is-invalid @enderror"><label>I agree with terms and service</label>
             @error('terms')
                <div class="caution-error">
                    {{ $message }}
                </div class="caution-error">    
            @enderror
            <button type="submit" data-ripple="">Register</button>
        </form>
        
        <span>already have an account? <a class="we-account underline" href="{{route('login')}}" title="">Sign in</a></span>
    </div>
</div>
@endsection

@push('custom-scripts')

<script type="text/javascript">
 jQuery(document).ready(function($) {

     $.getJSON('{{route('country')}}', function(data) {
            // console.log(data);
            // return false;
            $("#country").empty();
            $("#country").append('<option value="">Select Country</option>');
            $.each(data, function(key,val){
                console.log(val.id);
                $("#country").append('<option value="'+ val.id +'">'+ val.nicename +'</option>')
                $('#country').trigger('chosen:updated');
            });
        });

    });
</script>

@endpush





                    