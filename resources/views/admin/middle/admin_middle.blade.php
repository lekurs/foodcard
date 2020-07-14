@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="home">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
{{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

        @else
            @foreach($stores as $store)
                <h2>{{$store->name}}</h2>
            @endforeach
        @endif
    </div>
@endsection

@section('navigation')
    @parent
@endsection

@section('body')
    <div class="mout-admin-middle-nav-buttons-max-container">
        <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store btn-nav-max-size"><i class="fal fa-home"></i><span class="btn-description">Mon établissement</span></a>
        <a href="{{route('adminMiddleAccountShow')}}" class="btn mout-admin-middle-nav-buttons btn-account btn-nav-max-size"><i class="fal fa-smile"></i><span class="btn-description">Mon compte</span></a>
        <a href="#" class="btn mout-admin-middle-nav-buttons btn-menu btn-nav-max-size"><i class="fal fa-concierge-bell"></i><span class="btn-description">Ma carte</span></a>
    </div>
@endsection
