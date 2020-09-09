@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store"
         style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('/images/header-store.jpg') }}@endif') ">
        @if( isset($store) && !empty($medias) )
            <img src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
        @else
            <h2 class="mout-admin-middle-store-name mout--regular">{{request()->session()->get('store')->name}}</h2>
        @endif

        <div class="mout-admin-middle-header-nav-ariane" id="store">
            <i class="fal fa-home"></i>
            <p>mon établissement</p>
        </div>
    </div>
@endsection
@section('navigation')
    @parent
            <div class="mout-admin-middle-nav-buttons-container">
                <a href="{{route('adminMiddleAccountShow')}}" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>
                <a href="{{route('adminMiddleMenuShow')}}" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>
            </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="mout-admin-middle-users-container">
            <div class="mout-admin-middle-users-manager">
                <p class="edit-user" data-user=""><span class="mout-middle-edit-user-icon"><i class="fal fa-user"></i></span></p>
                <p class="mout--fat">collaborateurs</p>
                <a href="#" class="btn mout-btn-add-middle mout-btn-form-middle"><span><i class="fal fa-plus"></i> collaborateur</span></a>
            </div>
            <div class="mout-admin-middle-usercards-container">
                @foreach($usersByStore->users()->get() as $userByStore)
                    @include('layouts.usercards.usercards')
                @endforeach
            </div>
        </div>

        <div class="mout-admin-middle-form-container" id="add-user">
            @include('forms.middle.users.__user_creation_middle')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/middle-admin/users-manager.js') }}"></script>
@endsection
