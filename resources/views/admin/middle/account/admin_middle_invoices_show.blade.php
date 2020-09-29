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

        <div class="mout-admin-middle-header-nav-ariane" id="account">
            <i class="fal fa-smile"></i>
            <p>mon compte</p>
        </div>
    </div>
@endsection
@section('navigation')
    @parent
    <div class="mout-admin-middle-nav-buttons-container nav-four-buttons">
        <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
        <a href="{{route('adminMiddleMenuShow')}}" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>
        <a href="{{route('adminMiddleQRCorde')}}" class="btn mout-admin-middle-nav-buttons btn-qrcode"><i class="fal fa-qrcode"></i></a>
        <a href="#" class="btn mout-admin-middle-nav-buttons btn-payment"><i class="fal fa-credit-card"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel" id="invoices">
        <div class="mout-admin-middle-invoices-container">
            <div class="mout-admin-middle-container" id="invoices">
                <div class="mout-admin-middle-container-ariane mout--regular"><span class="invoice-icon"><i class="fal fa-file-alt"></i></span> Mes factures</div>
                <div class="mout-admin-middle-content" id="invoices">
                    <table class="mout-table table mout-admin-middle-invoices-table">
                        <thead>
                        <tr>
                            <th>télécharger</th>
                            <th>factures</th>
                            <th>date</th>
                            <th>montant</th>
                            <th>infos paiement</th>
                            <th>imprimer</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td><i class="fal fa-file-download"></i></td>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ $invoice->created }}</td>
                            <td>{{ $invoice->amount_paid }}</td>
                            <td>carte bancaire</td>
                            <td><i class="fal fa-print"></i></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mout-admin-middle-invoice-paginator">
{{--                        <i class="fal fa-chevron-right"></i>--}}
                    </div>
                </div>
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
