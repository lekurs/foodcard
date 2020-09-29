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

        <div class="foodcard-category-container" id="products">
            <div class="subcategories-container">
                <a href="{{ url()->previous() }}" class="btn mout-btn-client-subcategories mout--regular">
                    <span class="client-subcategories back"><i class="fas fa-arrow-left"></i></span>
                    {{ $subcategory->categoryLocalesFR->first()->libelle }}
                </a>
            </div>

            @foreach($category->products as $product)
                @if ( !is_null($product->stores->first()) )
                <a href="{{ route('apiClientProductShow', [$store->slug, $category->parent, $category->id, $product->id]) }}" class="foodcard-category-content">
                    <img src="{{ asset('/storage/products/' . $product->catalogueProductMedias->first()->path) }}" alt="{{ $product->langueFR->first()->libelle }}">
                    <div class="product-information-container">
                        <p class="text-center mout--regular">{{ $product->langueFR->libelle }}</p>
                        <p class="text-center mout--regular product-price">{{ $product->catalogueProductFloats->first()->price }} €</p>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
