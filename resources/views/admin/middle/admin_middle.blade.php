@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="home">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
{{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

        @else
        <h2>Nom du magasin
{{--            {{$store->name}}--}}
        </h2>
        @endif
    </div>
@endsection

@section('navigation')
    @parent
{{--        <div class="mout-admin-middle-nav-buttons-container">--}}
{{--            <a href="#" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>--}}
{{--            <a href="#" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>--}}
{{--        </div>--}}
@endsection

@section('body')
    <div class="mout-admin-middle-nav-buttons-max-container">
        <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store btn-nav-max-size"><i class="fal fa-home"></i><span class="btn-description">Mon établissement</span></a>
        <a href="#" class="btn mout-admin-middle-nav-buttons btn-account btn-nav-max-size"><i class="fal fa-smile"></i><span class="btn-description">Mon établissement</span></a>
        <a href="#" class="btn mout-admin-middle-nav-buttons btn-menu btn-nav-max-size"><i class="fal fa-concierge-bell"></i><span class="btn-description">Mon établissement</span></a>
    </div>
@endsection
