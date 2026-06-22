@extends('layout')

@section('title', $nome)

@section('pageStyle')
    <link rel="stylesheet" href="{{ url('css/profile.css') }}">
@endsection

@section('pageScript')
    <meta name='userID' content="{{ $id }}">
    <script src="{{ url('js/profile.js') }}" defer></script>
@endsection

@section('header-content')

<div id='user-box'>
    <div id='profile-pic'></div>
    <div id='name-desc'>
        <h1 id='name'>NOME</h1>
        <p id='desc'>DESC</p>
    </div>
    @if(session('user_id') === $id)
    <div id='account-management'>
        <a href="/logout">LOGOUT</a><br>
        <a href="/deleteAccount">ELIMINA_ACCOUNT</a><br>
    </div>
    @endif
</div>


@endsection

@section('content')
<div id='selection'>
    <button id='posts-btn'>Post</button>
    <button id='liked-btn'>Piaciuti</button>
</div>
<div id='profile-content'></div>
@endsection