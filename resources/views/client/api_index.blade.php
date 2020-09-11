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
    <div class="foodcard-navigation-container">
        <div class="foodcard-navigation" id="menu">
            <i class="fal fa-concierge-bell"></i>
            <p class="mout--regular">la carte</p>
        </div>

        <div class="foodcard-navigation" id="all">
            @foreach($categories as $category)
                @foreach($category->categoryLocales as $locale)
                <a href="{{ route('apiClientChooseCategory', [$store->slug, $category->id]) }}" class="foodcard-navigation-content">
                {!! $locale->icon !!}
                    <p class="mout--regular">{{ $locale->libelle }}</p>
                </a>
                @endforeach
            @endforeach

            <a href="" class="foodcard-navigation-content">
                <i class="fal fa-hat-chef"></i>
                <p class="mout--regular">formules</p>
            </a>

            <a href="" class="foodcard-navigation-content">
                <i class="fal fa-comment-exclamation"></i>
                <p class="mout--regular">allergènes</p>
            </a>
        </div>
    </div>
@endsection
