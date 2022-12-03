@extends('layouts.app-auth')

@section('content')
    <div class="container">
        <div class="account-content">
            <div class="account-header">
                <a href="/">
                    <img src="{{ asset('image/Ataru.jpg') }}" alt="main-logo" width="100">
                </a>
                <h3>Login</h3>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-24 icon">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <img src="/assets/images/icon/sms.svg" alt="sms">
                </div>
                <div class="form-group mb-24 icon">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <img src="/assets/images/icon/key.svg" alt="key">
                </div>
                <div class="form-group mb-24">
                    <button type="submit" class="default-btn">Log In</button>
                </div>
            </form>
        </div>
    </div>
@endsection
