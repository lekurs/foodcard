@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">

        @else
        <h2>{{$store->name}}</h2>
        @endif
    </div>
@endsection

@section('body')

@endsection
