@extends('auth.auth', ['title' => 'Login'])
@section('formauth')
<div class="col-lg-4">
    <div class="we-login-register">
        <div class="form-title">
            <i class="fa fa-key"></i>login
            <span>Sign in now and join wit the awesome event around the world.</span>
        </div>
        <form class="we-form" method="post" action="{{ route('login') }}" id="login-form">
            @csrf
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
            <input type="checkbox"><label>remember me</label>
            <button type="submit" data-ripple="">sign in</button>
            <a class="forgot underline" href="#" title="">forgot password?</a>
        </form>
        <span>don't have an account? <a class="we-account underline" href="{{route('register')}}" title="">register now</a></span>
    </div>
</div>
@endsection