@extends('layouts.middle-layout')
@section('title', ' Mes formules')

@section('header')
    <div class="mout-admin-middle-header-container" id="store"
         style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('/images/header-store.jpg') }}@endif') ">
        @if( isset($store) && !empty($medias) )
            <img src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
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
        <a href="{{ route('adminMiddleStoreShow') }}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
        <a href="{{ route('adminMiddleAccountShow') }}" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel text-center">
        <div class="options-menus-container">
            <a href="{{ route('formulaShow') }}" class="btn">Voir ma carte</a>
            <a href="{{ route('formulaShow') }}" class="btn">Créer ma formule</a>
        </div>
        <div class="mout-admin-formula-container">
            Mes formules
        </div>
    </div>

@endsection
