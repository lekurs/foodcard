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
        <a href="{{route('adminMiddleMenuShow')}}" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="mout-admin-middle-users-container">
            <div class="mout-admin-middle-users-manager">
                <p class="edit-user" data-user=""><span class="mout-middle-edit-user-icon"><i class="fal fa-user"></i></span></p>
                <p class="mout--fat">{{auth()->user()->name . ' ' . auth()->user()->lastname}}</p>
                <a href="#" class="btn mout-btn-edit-middle mout-btn-form-middle">modifier</a>
            </div>
            <div class="mout-admin-middle-usercards-container">
                <a href="{{route('adminMiddleQRCorde')}}" class="btn mout-admin-middle-nav-buttons-account btn-qrcode mout--regular">
                    <i class="fal fa-qrcode"></i>QRcode
                </a>
                <a href="{{route('adminMiddleAccountInvoicesShow')}}" class="btn mout-admin-middle-nav-buttons-account btn-invoices mout--regular">
                    <i class="fal fa-file-alt"></i>mes factures
                </a>
                <a href="{{route('adminMiddleBillingPortalShow')}}" class="btn mout-admin-middle-nav-buttons-account btn-payment mout--regular">
                    <i class="fal fa-credit-card"></i>mon mode de paiement
                </a>
            </div>
        </div>

        <div class="mout-admin-middle-form-container" id="edit-account">
            <span class="close-form-container"><i class="fal fa-times"></i></span>
            @include('forms.middle.users.__user_creation_middle')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>
@endsection
