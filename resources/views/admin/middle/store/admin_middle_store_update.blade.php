@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store">
        @if( isset($store) && !empty($store->storeMedias->first()->logo) )
            {{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

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
        <form action="{{ route('storeInformationsUpdate', $store->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('flashes.errors')

            <input type="hidden" name="store_id" id="store_id" value="{{ $store->id}}">

            <div class="store-form-left-container">
                <div class="floating-label">
                    <input type="text" name="name" id="name" class="floating-input form-control" placeholder=" " required autofocus value="@isset( $store ){{ $store->name }}@endisset">
                    <label for="name" class="float form-control-label">Nom de l'établissement</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="address" id="address" class="floating-input form-control" placeholder=" " required value="@isset( $store ){{ $store->address }}@endisset">
                    <label for="address" class="float form-control-label">Addresse de l'établissement</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="address_complement" id="address_complement" class="floating-input form-control" placeholder=" " value="@isset( $store ){{ $store->address_complement }}@endisset">
                    <label for="address_complement" class="float form-control-label">Complément d'addresse</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="zip" id="zip" class="floating-input form-control" placeholder=" " required value="@isset( $store ){{ $store->zip }}@endisset">
                    <label for="zip" class="float form-control-label">Code Postal</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="city" id="city" class="floating-input form-control" placeholder=" " value="@isset( $store ){{ $store->city }}@endisset">
                    <label for="city" class="float form-control-label">Ville</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="phone" id="phone" class="floating-input form-control" placeholder=" " value="@isset( $store ){{ $store->phone }}@endisset">
                    <label for="phone" class="float form-control-label">Téléphone</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="tva" id="tva" class="floating-input form-control" placeholder=" " value="@isset( $store ){{ $store->tva }}@endisset">
                    <label for="tva" class="float form-control-label">N° TVA Intracommunautaire</label>
                </div>

                <div class="floating-label">
                    <input type="text" name="siren" id="siren" class="floating-input form-control" placeholder=" " required value="@isset( $store ){{ $store->siren }}@endisset">
                    <label for="siren" class="float form-control-label">Siren</label>
                </div>

                <div class="floating-label">
                    <select name="storetype" id="storetype">
                        <option value="" selected>-- {{ $store->storeType->type }} --</option>
                        @foreach($storeTypes as $storeType)
                            <option value="{{ $storeType->id }}">{{ $storeType->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="floating-label">
                    <input type="checkbox" name="main" id="main" value="1" @if($store->main > 0) checked @endif>
                    <label for="main" class="mout--regular">Etablissement principal</label>
                </div>
            </div>

            <div class="store-form-right-container">

                <div class="download-informations-store" id="download-store-logo">
                    <i class="fal fa-download"></i>
                    téléchargez votre logo

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="storelogo" id="storelogo">
                            <label class="custom-file-label" for="storelogo">Selectionnez votre logo</label>
                        </div>
                    </div>
                </div>

                <div class="download-informations-store">
                    <i class="fal fa-download"></i>
                    téléchargez votre photo de couverture

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="storeillustration" accept="image/*" id="storeillustration">
                            <label class="custom-file-label" for="storeillustration">Selectionnez votre image de couverture</label>
                        </div>
                    </div>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn mout-btn-login">enregistrer</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/middle-admin/users-manager.js') }}"></script>
{{--    <script src="{{asset('/js/plugins/add-media.js')}}"></script>--}}

{{--    <script>--}}
{{--        $('.images').addMedia({--}}
{{--            width: '300px',--}}
{{--            height: '300px',--}}
{{--            onDelete: function (url) {--}}
{{--                //Ici on fait l'ajax pour supprimer--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
