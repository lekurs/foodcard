@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
            {{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

        @else
            <h2 class="mout-admin-middle-store-name mout--regular">{{request()->session()->get('store')->name}}</h2>
        @endif

        <div class="mout-admin-middle-header-nav-ariane" id="account">
            <i class="fal fa-home"></i>
            <p>mon compte</p>
        </div>
    </div>
@endsection
@section('navigation')
    @parent
    <div class="mout-admin-middle-nav-buttons-container">
        <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
        <a href="#" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>
        <a href="{{route('adminMiddleAccountInvoicesShow')}}" class="btn btn-min-nav btn-store btn-min-nav mout-admin-middle-nav-buttons btn-invoices"><i class="fal fa-file-alt"></i></a>
        <a href="{{route('adminMiddleAccountInvoicesShow')}}" class="btn btn-menu btn-min-nav mout-admin-middle-nav-buttons btn-payment"><i class="fal fa-credit-card"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="mout-admin-middle-qrcode-container text-center">
            <div class="qrcode-container">
                {!! $qrcode !!}
                <div class="btn-container text-center mt-3">
                    <button class="btn mout-btn-login" id="print-qrcode" onclick="window.print()">Imprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>
@endsection
