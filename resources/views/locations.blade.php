@extends('layout')

@section('title', 'Luoghi')

@section('pageStyle')
    <link rel="stylesheet" href="{{ url('css/locations.css') }}">
@endsection

@section('pageScript')
    <script src="{{ url('js/locations.js') }}" defer></script>
@endsection

@section('content')
<div id='choice'>
    <button id='all-btn'>Tutti</button>
    <button id='visited'>Visitati</button>
</div>
<div class='places'></div>
@endsection