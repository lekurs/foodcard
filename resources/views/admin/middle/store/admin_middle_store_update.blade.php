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
    <div class="mout-admin-middle-content-panel" id="edit-store">
        <form action="{{ route('storeInformationsUpdate', $store->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('flashes.errors')

            <input type="hidden" name="store_id" id="store_id" value="{{ $store->id}}">

            <div class="store-form-container">
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
                    <p class="mout--regular">téléchargez votre logo</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="storeMedias[logo][]" id="storelogo">
                            <label class="custom-file-label" for="storelogo">Selectionnez votre logo</label>
                        </div>
                    </div>

                    @if( isset($store) && !empty($medias) )
                        <img id="img-logo" src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
                    @else
                    <img src="" alt="" id="img-logo">
                    @endif
                </div>

                <div class="download-informations-store">
                    <i class="fal fa-download"></i>
                    <p class="mout--regular">téléchargez votre photo de couverture</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="storeMedias[illustration][]" accept="image/*" id="storeillustration">
                            <label class="custom-file-label" for="storeillustration">Selectionnez votre image de couverture</label>
                        </div>
                    </div>
                </div>

                @if( isset($store) && !empty($medias) )
                    <img id="img-illustration" src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}" alt="{{$store->name}}" class="img-fluid">
                @else
                    <img src="" alt="" id="img-illustration">
                @endif

                <div class="button-container">
                    <button type="submit" class="btn mout-btn-login">enregistrer</button>
                </div>
            </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/middle-admin/users-manager.js') }}"></script>
{{--    <script src="{{asset('/js/plugins/add-media.js')}}"></script>--}}

    <script>
        $('#storelogo').on('change', function () {
            let img = $('img#img-logo');
            readURL($(this), img);

        });

        $('#storeillustration').on('change', function () {
           let img = $('img#img-illustration');
           readURL($(this), img);
        });

        function readURL(input, img) {
            if (input[0].files && input[0].files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    img.attr('src', e.target.result);

                };
                reader.readAsDataURL(input[0].files[0]);
            }
        }
    </script>
@endsection
