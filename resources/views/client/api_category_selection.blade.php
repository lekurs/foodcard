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

        <div class="foodcard-category-container" id="category">
            @foreach($subcategories as $subcategory)
                @foreach($subcategory->categoryLocales as $locale)
                    <a href="{{ route('apiClientProductSelection', [$store->slug, $subcategory->parent, $subcategory->id]) }}" class="foodcard-category-content">
                        <img src="{{ asset('/storage/category/' . $locale->slug . '/' . $locale->img_path) }}" alt="{{ $locale->libelle }}">
                        <p class="text-center mout--regular">{{ $locale->libelle }}</p>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
