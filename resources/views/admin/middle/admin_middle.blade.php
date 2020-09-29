@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store"
         style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('/images/header-store.jpg') }}@endif') ">
        @if( isset($store) && !empty($medias) )
            <img src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
        @else
            <h2 class="mout-admin-middle-store-name mout--regular" id="home">{{request()->session()->get('store')->name}}</h2>
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
        <a href="{{route('adminMiddleMenuShow')}}" class="btn mout-admin-middle-nav-buttons btn-menu btn-nav-max-size"><i class="fal fa-concierge-bell"></i><span class="btn-description">Ma carte</span></a>
    </div>
@endsection
