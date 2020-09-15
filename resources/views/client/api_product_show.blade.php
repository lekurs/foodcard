@extends('layouts.api_store_layout')

@section('header')
    <div class="foodcard-header-container"
         style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('/images/header-store.jpg') }}@endif') ">
        @if( isset($store) && !empty($medias) )
            <img src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
        @else
            <h2 class="foodcard-store-name mout--regular">{{$store->name}}</h2>
        @endif
    </div>
@endsection

@section('body')

    <div class="foodcard-container">
        @include('client.includes.api_navigation')

        <div class="foodcard-category-container" id="product">
            <div class="subcategories-container">
                <a href="" class="btn mout-btn-client-subcategories mout--regular">
                    <span class="client-subcategories back"><i class="fas fa-arrow-left"></i></span>
                    {{ $subcategory->categoryLocalesFR->first()->libelle }}
                </a>
            </div>

            <div class="product-container">
                <div class="product-images-container">
                    @foreach($product->catalogueProductMedias()->get() as $media)
                        <div class="product-image-slide-content">
                            <img src="{{ asset('/storage/products/' . $media->path) }}" alt="{{ $product->langueFR->libelle }}" />
                        </div>
                    @endforeach
                </div>

                <div class="product-informations-container">
                    <h1 class="product-information" id="name">{{ $product->langueFR->libelle }}</h1>
                    <p class="product-information" id="price">{{ $product->catalogueProductFloats->first()->price }} €</p>
                    <p class="product-information" id="description">{!! $product->langueFR->description !!}</p>
                </div>
            </div>
            <div class="product-allergy-container">
                @if(in_array('|', $product->allergy))
                    {{ $product->allergy }}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.product-images-container').slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            adaptiveHeight: true,
            arrows: false,
        });
    </script>
@endsection
