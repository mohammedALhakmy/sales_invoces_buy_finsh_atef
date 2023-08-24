@extends('layouts.admin')
@section('title')
    Dashboard
@endsection

@section('contentHeader')
    Home
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.dashboard') }}">Home</a>
@endsection

@section('contentHeaderActive')
    show
@endsection

@section('content')
    <div class="row" style="background-image: url({{asset('assets/admin/images/dash.jpg')}});background-repeat: no-repeat;background-size: cover;min-height: 600px">

    </div>
@endsection
