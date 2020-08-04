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
        <div class="my-menu-category-container">
            <div class="my-menu-category-buttons-container">
                @foreach($categories as $category)
                    <a href="#" class="btn btn-search-menu btn-my-category mout--regular @if(request()->query->get('category')) test @endif" id="{{$category->slug}}" style="{{$category->color}}"><span class="btn-my-menu-icon-container">{!! $category->icon !!}</span>{{$category->libelle}}</a>
                @endforeach
            </div>
            <div class="my-menu-container" id="my-menu-container-creation">
                <a href="#" class="btn btn-search-menu btn-my-menu mout--regular"><span class="btn-my-menu-icon-container"><i class="fal fa-search"></i></span>Je recherche</a>
                <button class="btn btn-create-menu btn-my-menu mout--regular" data-toggle="modal" data-target="#productCreation"><span class="btn-my-menu-icon-container"><i class="fal fa-bell"></i></span>Je crée </button>
                <a href="#" class="btn btn-create-menu btn-my-menu mout--regular"><span class="btn-my-menu-icon-container"><i class="fal fa-concierge-bell"></i></span>Voir ma carte</a>
                <a href="#" class="btn btn-create-menu btn-my-menu mout--regular"><span class="btn-my-menu-icon-container"><i class="fal fa-hat-chef"></i></span>Créer ma<br>formule</a>
            </div>
        </div>

        <div class="my-menu-add-product-container">
            @include('forms.middle.menu.__menu_creation')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>
    <script src="{{asset('/js/plugins/add-media.js')}}"></script>
    <script src="{{asset('js/admin/manage-allergy.js')}}"></script>
    <script src="{{asset('js/admin/manage-product-admin.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.images').addMedia({
                width: '300px',
                height: '300px',
                onDelete: function (url) {
                    console.log(url);
                    //Ici on fait l'ajax pour supprimer
                }
            });
        })
    </script>
@endsection
