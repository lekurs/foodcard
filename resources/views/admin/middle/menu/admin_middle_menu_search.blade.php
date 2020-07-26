@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
            {{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

        @else
            <h2 class="mout-admin-middle-store-name mout--regular">{{request()->session()->get('store')->name}}</h2>
        @endif

        <div class="mout-admin-middle-header-nav-ariane" id="menu">
            <i class="fal fa-concierge-bell"></i>
            <p>ma carte</p>
        </div>
    </div>
@endsection
@section('navigation')
    @parent
            <div class="mout-admin-middle-nav-buttons-container">
                <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
                <a href="{{route('adminMiddleAccountShow')}}" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>
            </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="mout-admin-middle-menus-container">
            
        </div>
    </div>
@endsection

@section('js')

@endsection
