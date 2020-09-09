<div class="mout-admin-middle-header-container" id="store"
     style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('/images/header-store.jpg') }}@endif') ">
    @if( isset($store) && !empty($medias) )
        <img src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
    @else
        <h2 class="mout-admin-middle-store-name mout--regular">{{request()->session()->get('store')->name}}</h2>
    @endif

    <div class="mout-admin-middle-header-nav-ariane" id="{{ $page }}">
        <i class="fal fa-home"></i>
        <p>{{ $textPage }}</p>
    </div>
</div>
