@extends('layout')

@section('title', 'Register')

@section('pageStyle')
    <link rel="stylesheet" href="{{ url('css/register.css') }}">
@endsection

@section('pageScript')
    <script src="{{ url('js/register.js') }}" defer></script>
@endsection

@section('content')
<div>
    <form action="/register" method="POST">
    @csrf 
    <h2>Registrati</h2>
    <div id='input-container'>
        <div>
            <label for="nickname">Nickname:</label>
            <input type="text" name="nickname" id="nickname" required>
            <span id="nickname-error" class='error-msg'>@if(session('errMsgNick')){{ session('errMsgNick') }} @endif</span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <span id="password-error" class='error-msg'>@if(session('errMsgPwd')){{ session('errMsgPwd') }} @endif</span>
        </div>
        <button type="submit" id="register-button">Registrati</button>
    </div>
    </form>

    <div id='second-box'>
        <h2>Hai un account?</h2>
        <div id='alternative'>
            <a href='/login'>Accedi</a>
            <a href='/redirect/lastfm'>Accedi con LastFM</a>
        </div>
    </div>
</div>
@endsection