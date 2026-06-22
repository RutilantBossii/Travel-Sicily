@extends('layout')

@section('title', $nome)

@section('pageStyle')
    <link rel="stylesheet" href="{{ url('css/locationPage.css') }}">
@endsection

@section('pageScript')
    <meta name='placeID' content="{{ $id }}">
    <script src="{{ url('js/locationPage.js') }}" defer></script>
@endsection

@section('content')
<div class='info-box'>
    <h1>{{$nome}}</h1>
    <p>{{ $descrizione }}</p>
</div>

@if(session('user_id'))
<div id='utility-box'>
    <div id='post-box'>
        <div id='upper-post-area'>
            <h2>Crea un post</h2>
            <button id='post-btn'>Posta</button>
        </div>
        <textarea id='post-text' placeholder='Scrivi qualcosa...'></textarea>
        <span id='errMsg'></span>
    </div>
    <div id='api-box'>
        <div id='api-info-box'>
        </div>
    </div>
</div>
@endif

<div id='content-cards'>
</div>
@endsection