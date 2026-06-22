@extends('layout')

@section('title', 'Login')

@section('pageStyle')
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
@endsection

@section('pageScript')
    <script src="{{ url('js/login.js') }}" defer></script>
@endsection

@section('content')
<div>
    <form action="/login" method="POST">
    @csrf 
    <h2>Accedi al sito</h2>
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
        <button type="submit" id="login-button">Accedi</button>
    </div>
    </form>

    <div id='second-box'>
        <h2>Non hai un account?</h2>
        <div id='alternative'>
            <a href='/register'>Registrati</a>
            <a href='/redirect/lastfm'>Accedi con LastFM</a>
        </div>
    </div>
</div>
@endsection