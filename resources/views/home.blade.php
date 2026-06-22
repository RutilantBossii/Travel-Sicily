@extends('layout')

@section('title', 'Home')

@section('pageStyle')
    <link rel="stylesheet" href="{{ url('css/home.css') }}">
@endsection

@section('pageScript')
    <script src="{{ url('js/home.js') }}" defer></script>
@endsection

@section('content')
<div id='content-cards'></div>
@endsection