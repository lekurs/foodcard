@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
            {{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

        @else
            <h2>Nom du magasin
                {{--            {{$store->name}}--}}
            </h2>
        @endif

        <div class="mout-admin-middle-header-nav-ariane">
            <i class="fal fa-home"></i>
            <p>mon établissement</p>
        </div>
    </div>
@endsection
@section('navigation')
    @parent
            <div class="mout-admin-middle-nav-buttons-container">
                <a href="#" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>
                <a href="#" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>
            </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="mout-admin-middle-users-container">
            <div class="mout-admin-middle-users-manager">
                <p class="edit-user" data-user=""><span class="mout-middle-edit-user-icon"><i class="fal fa-user"></i></span></p>
                <p class="mout--fat">collaborateurs</p>
                <a href="#" class="btn mout-btn-add-middle"><span><i class="fal fa-plus"></i> collaborateur</span></a>
            </div>
            <div class="mout-admin-middle-usercards-container">
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
                @include('layouts.usercards.usercards')
            </div>
        </div>

        <div class="mout-admin-middle-form-container">
            @include('forms.middle.users.__user_creation_middle')
        </div>
    </div>
{{--</div>--}}
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>
@endsection
