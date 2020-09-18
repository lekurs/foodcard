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
        <a href="{{ route('adminMiddleStoreShow') }}" class="btn mout-admin-middle-nav-buttons btn-store"><i
                class="fal fa-home"></i></a>
        <a href="{{ route('adminMiddleAccountShow') }}" class="btn mout-admin-middle-nav-buttons btn-account"><i
                class="fal fa-smile"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="select-action-panel">
            <button class="btn btn-search-menu btn-my-menu mout--regular">
                <span class="btn-my-menu-icon-container"><i class="fal fa-magic"></i></span>Je crée
            </button>

            <p class="mout--regular">OU</p>

        </div>
        <div class="my-menu-container" id="insert_new_product">
            <div class="my-menu-subcategory-container">
                <div class="my-submenu-category-container" id="edit-product">
                    @foreach($subcategories as $subcategory)
                        <div class="submenu-category-content text-center office"
                             data-subcategory="{{ $subcategory['catalogue_category_id'] }}"
                             data-value="{{ $subcategory['libelle'] }}">
                            <img src="{{asset('/storage/category/' . \Illuminate\Support\Str::slug($subcategory['libelle']) . '/' . $subcategory['img_path'])}}" alt="{{$subcategory['libelle']}}">
                            <p class="submenu-category mout--regular">{{ $subcategory['libelle'] }}</p>
                        </div>
                    @endforeach
                </div>

                <table id="{{ $category->categoryLocales()->first()->slug }}"
                       class="table table-hover mout-bo-table table-starters">
                    <thead>
                    <tr>
                        <th>{{ $category->categoryLocales()->first()->libelle }}</th>
                        <th>Type</th>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Editer</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($category->products as $product)
                        <tr>
                            <td>@if(!is_null($product->catalogueProductMedias->first))
                                    <img
                                        src="{{ asset('storage/products/' . $product->catalogueProductMedias->first()->path) }}"
                                        class="img-fluid mout-table-img" alt="{{ $product->langueFR->libelle }}">
                                @else <i class="fal fa-image fa-2x"></i>
                                @endif
                            </td>
                            <td>
                                @foreach($product->categories as $category)
                                    @if(!is_null($category->parent))
                                        {{ $category->categoryLocales->first()->libelle }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $product->langueFR->libelle }}</td>
                            <td>{!! $product->langueFR->description !!}</td>
                            <td class="foodcard-edit-product" data-value="{{ $product->id }}"><i class="fal fa-edit" style="font-size: 1.5em"></i></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="my-menu-creation-container">
                <form action="{{ route('adminMiddleMenuCreateStore', $category) }}" method="post"
                      enctype="multipart/form-data" id="edit-product-form">
                    @csrf
                    @include('flashes.errors')

                    <input type="hidden" name="product_id" id="product_id" value="{{ request()->productId }}">

                    <div class="mout-admin-middle-menus-container">
                        <div class="images">

                        </div>
                    </div>

                    <div class="my-menu-creation-form-container">
                        <div class="my-menu-creation-form-content">
                            <div class="product-langage-selection"></div>
                            <div class="input-group floating-label">
                                <div class="input-group-prepend choose-langage">
                                    <div class="mout-dropdown">
                                        <input class="mout-dropdown-toggle" type="text">
                                        <div id="chTxt" class="mout-dropdown-text">
                                            <img src="{{ asset('images/flags/'. $locales->first()->label . '.png') }}"
                                                 class="img-fluid choice-lg" data-id="{{$locales->first()->id}}">
                                        </div>
                                        <ul class="mout-dropdown-content">
                                            @foreach($locales as $locale)
                                                <li>
                                                    <img src="{{ asset('images/flags/'. $locale->label . '.png') }}"
                                                         class="img-fluid choice-lg" data-id="{{$locale->id}}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @foreach($locales as $locale)
                                    <input type="text" name="locale[{{$locale->id}}][libelle]"
                                           id="product_{{ $locale->id }}"
                                           class="form-control floating-input product_{{ $locale->id }} product_label product_label_{{ $locale->label }}"
                                           data-langue="{{ $locale->label }}"
                                           placeholder=" "
                                           value="">
                                    <label for="locale[{{$locale->id}}][libelle]" class="float">Intitulé</label>
                                @endforeach
                                <div class="input-group-append category">
                                <span class="btn btn-search-menu btn-my-category mout--regular" id="{{$category->slug}}"
                                      style="{{$category->color}}">
                                    <span class="btn-my-menu-icon-container">{!! $category->icon !!}</span>
                                    {{$category->libelle}}
                                </span>
                                </div>
                            </div>

                            <div class="floating-label">
                                @foreach($locales as $locale)
                                    <div class="textarea-container product_label product_{{$locale->id}}">
                                        <label for="locale[{{$locale->id}}][description]" class="mout--regular">Description*</label>
                                        <textarea name="locale[{{$locale->id}}][description]"
                                                  id="product_description_{{$locale->id}}"
                                                  class="floating-textarea product_description_{{ $locale->label }}"></textarea>
                                    </div>
                                @endforeach
                            </div>

                            <input type="hidden" name="store_id"
                                   value="@if(request()->session()->get('store')){{request()->session()->get('store')->id}}@endif"
                                   id="store">

                            <div class="floating-label">
                                <input type="text" name="float[price]" id="product_price"
                                       class="floating-input product_price" placeholder=" "
                                       value="">
                                <label for="price" class="float">Prix</label>
                            </div>

                            <div class="floating-label">
                                <input type="text" name="float[special_price]" id="product_special_price"
                                       class="floating-input product_special_price"
                                       placeholder=" " >
                                <label for="special_price" class="float">Prix spécial</label>
                            </div>

                            <div class="floating-label">
                                <input type="text" name="float[buying_price]" id="product_buying_price"
                                       class="floating-input product_buy_price"
                                       placeholder=" " >
                                <label for="buying_price" class="float">Prix d'achat</label>
                            </div>

                            <div class="floating-label">
                                <h5 class="allergy mout--regular">allergènes</h5>
                                <div class="button-allergy-container">
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('egg', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="egg"><i class="far fa-egg-fried"></i><br> Oeufs
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('fish', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="fish"><i class="fal fa-fish"></i><br> Poisson
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('crustace', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="crustace">
                                        <svg version="1.1" id="crustace" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0-crustace{fill:#FFFFFF;}
                                        </style>
                                            <g id="Groupe_277" transform="translate(221.366 -130.774)">
                                                <path id="Tracé_14587" class="st0-crustace" d="M-155.7,148h-9.8c1.1-1,1.9-2.3,2.3-3.8c0.5-2.2-0.2-4.5-2.1-6.8c-0.5-0.6-1.3-0.6-1.9-0.2
                                                    c-0.6,0.5-0.6,1.3-0.2,1.8c1.3,1.6,1.8,3.1,1.5,4.5c-0.3,0.9-0.8,1.8-1.5,2.5c0.2-0.8,0.3-1.7,0.2-2.6c-0.3-1.9-1.3-3.5-2.9-4.6
                                                    c-0.6-0.4-1.4-0.3-1.8,0.3c-0.4,0.6-0.3,1.4,0.3,1.8c1,0.6,1.6,1.6,1.8,2.8c0.1,1.4-0.4,2.8-1.2,4c0,0.1-0.1,0.1-0.1,0.2h-25
                                                    c-4.1-0.1-8,1.3-11.1,4.1c-3.9,3.6-5.9,9.3-5.9,16.8c0,0,0,0.1,0,0.1c0,0.1,1.5,14.3,18,16c0,0,0.1,0,0.1,0c0.7,0,1.3-0.6,1.3-1.3
                                                    c0-0.3-0.1-0.5-0.2-0.8l-1.9-2.8l2.9-1.5c0.6-0.3,0.9-1.1,0.6-1.8c-0.2-0.4-0.6-0.6-1-0.7c-0.1,0-6.8-0.9-6.7-5.9
                                                    c-0.1-1.6,0.7-3.2,2-4.2c1.7-1.2,4.4-1.3,7.1-0.4c0.1,0,0.3,0.1,0.5,0.2c-1.6,2.7-1.9,6-0.8,8.9c0.2,0.5,0.7,0.8,1.2,0.8
                                                    c0.7,0,1.3-0.6,1.3-1.3c0-0.2,0-0.4-0.1-0.5c-0.1-0.2-1.3-3.2,1-7.1c1.2,0.3,2.6,0.6,4.1,0.9c-0.8,2.1-1.2,4.4-1.2,6.7
                                                    c0,0.7,0.6,1.3,1.3,1.3c0.7,0,1.3-0.6,1.3-1.3c0-2.2,0.4-4.4,1.3-6.4c1.1,0.1,2.2,0.2,3.3,0.2c-0.9,2.2-1.3,4.5-1.3,6.9
                                                    c0,0.7,0.6,1.3,1.3,1.3c0.7,0,1.3-0.6,1.3-1.3c0-2.4,0.5-4.8,1.6-7c2.9-0.3,5.7-1.2,8.1-2.9c4.1-2.9,6.3-7.8,6.6-14.4h4.5
                                                    c0.7,0,1.3-0.6,1.3-1.3S-155,148-155.7,148L-155.7,148z M-197.1,177.9l-1.3,0.7c-0.6,0.3-0.9,1.1-0.6,1.8c0,0,0.1,0.1,0.1,0.1
                                                    l1,1.4c-11.2-2.6-12.5-12.2-12.6-13.1c0-2.3,0.2-4.7,0.8-7c3.4,0.8,6.1,3.3,7.2,6.6c-0.1,0.6-0.2,1.2-0.2,1.8
                                                    C-202.8,174.4-199.9,176.7-197.1,177.9z M-199.6,164c-0.5,0.4-1,0.8-1.4,1.3c-1.7-3-4.5-5.2-7.9-6c0.7-2,1.9-3.8,3.5-5.3
                                                    c1.6-1.4,3.5-2.5,5.5-3c1.5,0.9,6.2,4.5,4,11.6C-197.2,162.9-198.5,163.3-199.6,164L-199.6,164z M-190.1,163.3c-1-0.3-2-0.5-3-0.6
                                                    c1.3-4.3,0.1-8.9-3-12h0.1h11.7c0.8,1.6,2.6,6.3-2.3,10.7c-0.8,0.7-1.5,1.5-2.2,2.3C-189.4,163.5-189.8,163.4-190.1,163.3
                                                    L-190.1,163.3z M-168.4,162.9c-1.3,0.9-2.8,1.6-4.4,2c0.5-0.5,1-0.9,1.5-1.3c0.6-0.4,0.8-1.2,0.4-1.8c-0.4-0.6-1.2-0.8-1.8-0.4
                                                    c-1.5,1.1-2.8,2.5-3.8,4.1c-1.1,0.1-2.1,0-3.2,0c0.7-1,1.5-1.8,2.5-2.5c0.6-0.4,0.8-1.2,0.4-1.8c-0.4-0.6-1.2-0.8-1.8-0.4l0,0
                                                    c-1.6,1.2-3,2.7-4,4.4c-1.3-0.2-2.5-0.4-3.6-0.7c0.3-0.4,0.7-0.7,1.1-1.1c5.2-4.7,4.4-9.9,3.4-12.7h18.8
                                                    C-163.1,156.4-165,160.5-168.4,162.9L-168.4,162.9z"/>
                                                <path id="Tracé_14588" class="st0-crustace" d="M-170.9,156c0.9,0,1.6-0.7,1.6-1.6s-0.7-1.6-1.6-1.6s-1.6,0.7-1.6,1.6c0,0,0,0,0,0
		                                            C-172.5,155.3-171.8,156-170.9,156C-170.9,156-170.9,156-170.9,156z"/>
                                            </g>
                                        </svg>
                                        <br> Crustacé
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('mollusque', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="mollusque">
                                        <svg version="1.1" id="mollusques" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;"
                                             xml:space="preserve">
                                                <style type="text/css">
                                                    .st0-mollusque {
                                                        fill: #FFFFFF;
                                                    }
                                                </style>
                                            <g id="Groupe_276" transform="translate(-629.787 -222.313)">
                                                <path id="Tracé_14580" class="st0-mollusque" d="M651.5,271.5c-3.6,0-7.6-0.5-8.9-2.4c-2-3,1.7-10.6,3.4-13.7c3.5-6.3,7.9-11.7,11.7-14.2
                                                    l0,0c4-2.7,8.7-4.1,13.5-3.8c4.6,0.3,8.4,2.3,10.7,5.7c4.5,6.8,1.1,17.1-7.6,22.9c-3.9,2.6-10.5,4.5-17.7,5.3
                                                    C655.4,271.3,653.5,271.5,651.5,271.5z M670,240c-3.8,0.1-7.5,1.3-10.7,3.4l0,0c-8,5.3-15.9,21.8-14.4,24.1c0.4,0.6,3.9,1.7,11.4,1
                                                    c6.7-0.7,13-2.5,16.5-4.8c7.5-5,10.6-13.6,6.9-19.1c-2-2.8-5.2-4.4-8.6-4.5C670.7,240,670.4,239.9,670,240L670,240z M658.6,242.2
                                                    L658.6,242.2z"/>
                                                <path id="Tracé_14581" class="st0-mollusque" d="M647.6,270.5c-2.2,0-4.3-0.4-5.1-1.6c-1.2-1.8,0.4-5.5,2-8.2c2-3.6,4.6-6.6,6.9-8.1l0,0
                                                    c5.2-3.5,11.6-3,14.3,1c1.3,2.2,1.6,4.8,0.6,7.2c-1,2.6-2.8,4.8-5.2,6.4c-2.3,1.5-6.1,2.7-10.2,3.2
                                                    C649.8,270.4,648.7,270.5,647.6,270.5z M644.9,267.4c1.6,0.8,10.5,0.2,14.7-2.6c1.9-1.2,3.3-3,4.2-5c0.7-1.5,0.6-3.3-0.3-4.7
                                                    c-1.8-2.8-6.5-2.9-10.5-0.2C648.8,257.6,644.8,265.6,644.9,267.4L644.9,267.4z"/>
                                                <path id="Tracé_14582" class="st0-mollusque" d="M649.7,271c-3.4,0-6.1-0.6-7-2c-1.6-2.4,1.1-8.1,2.9-11.2c2.9-5.1,6.5-9.4,9.7-11.5
                                                    c7.3-4.8,16.1-4.2,19.8,1.3s0.7,13.9-6.5,18.7C664.4,269,655.9,271,649.7,271z M665.7,245.7c-3.1,0.1-6.2,1.1-8.8,2.8l0,0
                                                    c-7.2,4.8-12.6,17.5-11.9,19c1.1,1.2,15,1.1,22.1-3.6c6-4,8.6-10.7,5.8-14.9C671.4,246.8,668.7,245.7,665.7,245.7L665.7,245.7z
                                                     M656.1,247.4L656.1,247.4z"/>
                                                <path id="Tracé_14583" class="st0-mollusque" d="M652.2,271.6c-4,0-8.2-0.5-9.5-2.6c-3.4-5.1,8.6-26.3,18.6-33c10.5-6.9,23.3-6.2,28.5,1.7
                                                    s1,20-9.5,26.9c-4.6,3.1-12.6,5.5-21.2,6.5C656.9,271.5,654.6,271.6,652.2,271.6z M676.3,234c-4.8,0.1-9.5,1.6-13.4,4.3
                                                    c-10.1,6.7-19.7,26.4-17.9,29.2c0.6,1,5.5,2,13.8,1c8.1-0.9,15.7-3.3,20-6.1c9.2-6.1,13.1-16.5,8.7-23.1
                                                    C685.2,235.8,681.1,234,676.3,234L676.3,234z"/>
                                            </g>
                                        </svg>
                                        <br> Mollusque
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('gluten', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="gluten"><i class="fal fa-wheat"></i><br> Gluten
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('arachides', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="arachides">
                                        <svg version="1.1" id="arachide" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-arachide{fill:#FFFFFF;}
</style>
                                            <g id="Groupe_284" transform="matrix(0.996, -0.087, 0.087, 0.996, -957.055, -36.268)">
                                                <path id="Tracé_14608" class="st0-arachide" d="M1012.9,138.6c-1.2-1.8-5.5-4.5-10.6-4.9c-4.3-0.4-8.6,1.4-11.4,4.7
		c-6.9,7.9-8.4,8.2-14.5,9.3c-1.9,0.3-4.2,0.8-7.2,1.5c-5.9,1.4-10.4,4.7-12.6,9.1c-1.7,3.3-1.8,7.2-0.3,10.5c1.2,2.6,4,4.5,7.9,5.1
		c1.2,0.2,2.4,0.3,3.6,0.3c6.1,0,11.5-2.6,14.2-5.5c5.6-5.8,6.5-5.9,9.4-6.4c4.1-0.7,8.2-1.9,12-3.6c6.8-2.9,9.4-7.1,10.3-10.1
		C1014.9,145.3,1014.5,141.7,1012.9,138.6z M1011.6,148c-1.1,3.7-4.2,6.6-9,8.7c-3.6,1.7-7.5,2.8-11.5,3.5c-3.6,0.6-4.9,1-10.7,7
		c-3,3.1-7.7,4.6-12,4.7l-0.1-0.6c-0.1-0.6-0.8-1-1.4-0.9c-0.6,0.1-1,0.8-0.9,1.4c0,0,0,0,0,0l0,0.1c-0.5,0-1-0.1-1.4-0.2
		c-3.1-0.6-5.3-1.9-6.2-3.8c-1.2-2.8-1.1-5.9,0.2-8.6c1.9-3.8,5.8-6.6,11-7.8c2.9-0.7,5.2-1.1,7.1-1.5c6.7-1.2,8.6-1.8,15.7-9.9
		l0.1,0.5c0.1,0.6,0.8,1,1.4,0.9c0.6-0.1,1-0.8,0.9-1.4l-0.4-1.8c1.9-1.5,4.3-2.3,6.7-2.2c0.3,0,0.6,0,1,0c4.3,0.3,8.1,2.7,8.8,3.9
		C1012.2,142.4,1012.5,145.3,1011.6,148L1011.6,148z"/>
                                                <path id="Tracé_14609" class="st0-arachide" d="M962.5,164.4c4.7-4.8,10.6-8.1,17-9.7c0.6-0.1,1-0.8,0.9-1.4c-0.1-0.6-0.8-1-1.4-0.9
		c-4.8,1.1-9.3,3.2-13.3,6.1l-0.4-1.8c-0.1-0.6-0.8-1-1.4-0.9s-1,0.8-0.9,1.4l0.7,2.8c-1,0.8-2,1.7-2.9,2.7
		c-0.4,0.5-0.4,1.2,0.1,1.6C961.3,165,962,164.9,962.5,164.4L962.5,164.4z"/>
                                                <path id="Tracé_14610" class="st0-arachide" d="M983,153.4c0.1,0,0.2,0,0.3,0c1-0.3,2-0.7,2.9-1.2l0.4,1.6c0.1,0.5,0.6,0.9,1.1,0.9
		c0.1,0,0.2,0,0.3,0c0.6-0.1,1-0.8,0.9-1.4c0,0,0,0,0,0l-0.5-2.2c1.3-0.8,2.6-1.7,3.8-2.7c3.3-2.8,4.5-3.3,4.6-3.3
		c0.6-0.1,1-0.7,0.9-1.4c-0.1-0.6-0.6-1-1.2-0.9c-0.9,0.1-3,1.4-5.8,3.8c-2.4,2-5.1,3.5-8,4.6c-0.6,0.2-1,0.8-0.8,1.4
		C982,153.1,982.5,153.4,983,153.4L983,153.4z"/>
                                                <path id="Tracé_14611" class="st0-arachide" d="M999.7,143.5c0.1,0,0.3,0,0.4-0.1c0.1,0,5.1-2,8.2-1.9c0.6,0,1.2-0.5,1.2-1.1
		c0-0.6-0.5-1.1-1.1-1.2c-3.5-0.1-8.9,2-9.1,2.1c-0.6,0.2-0.9,0.9-0.6,1.5C998.8,143.3,999.2,143.5,999.7,143.5L999.7,143.5z"/>
                                                <path id="Tracé_14612" class="st0-arachide" d="M984.4,160.1c0.5-0.4,0.6-1.1,0.2-1.6c-0.4-0.5-1.1-0.6-1.6-0.2c-1.4,1-2.9,1.9-4.4,2.6
		l-1-2.1c-0.3-0.6-1-0.8-1.5-0.6c-0.6,0.3-0.8,1-0.6,1.5l0,0l1,2.1c-5.6,2.4-12.1,4.5-12.2,4.5c-0.6,0.2-1,0.8-0.8,1.4
		c0.1,0.5,0.6,0.8,1.1,0.8c0.1,0,0.2,0,0.3-0.1C965.5,168.3,979.6,163.9,984.4,160.1z"/>
                                                <path id="Tracé_14613" class="st0-arachide" d="M1008.6,145c-3,4.6-8.2,7.2-12.2,8.7l-0.5-2.2c-0.1-0.6-0.8-1-1.4-0.9
		c-0.6,0.1-1,0.8-0.9,1.4l0.6,2.4c-1.1,0.3-2.3,0.6-3.4,0.8c-0.6,0.1-1.1,0.7-1,1.3c0.1,0.6,0.7,1.1,1.3,1
		c0.6-0.1,13.6-2.1,19.5-11.2c0.4-0.5,0.2-1.2-0.3-1.6C1009.7,144.3,1009,144.5,1008.6,145C1008.7,145,1008.7,145,1008.6,145
		L1008.6,145z"/>
                                            </g>
</svg>
                                        <br> Arachides
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('nutts', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="nutts"><i class="fal fa-acorn"></i><br> Fruits à coque
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('soja', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="soja">
                                        <svg version="1.1" id="soja" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-soja{fill:#FFFFFF;}
</style>
                                            <g id="Groupe_286" transform="translate(-518.837 -215.584)">
                                                <path id="Tracé_14619" class="st0-soja" d="M570.2,267.2c-4.3,0-9.6-1.5-14.9-6.8c-2.4-0.4-12.9-2.6-14.5-14.6
		c-2.1-1.3-7.9-6.6-3.2-22.2c0.2-0.5,0.7-0.9,1.2-0.9c5.1,0.1,14.7,2.7,15.9,12c2.6,0.8,10.2,4.1,11.3,13.4c1.2,0.3,2.3,0.8,3.3,1.3
		c3,1.7,4.6,4.1,4.6,7c0.1,4.9,5.7,5.5,5.9,5.5c0.7,0.1,1.2,0.7,1.1,1.4c0,0.4-0.2,0.7-0.5,0.9C577.4,266.2,573.8,267.2,570.2,267.2
		z M539.7,225.2c-4.2,15.2,2.5,18.5,2.8,18.6c0.4,0.2,0.7,0.6,0.7,1c1.2,12.1,12.3,13.1,12.8,13.1c0.3,0,0.6,0.2,0.8,0.4
		c8,8.2,15.7,6.8,19.6,5.3c-2.9-1.1-4.9-3.9-4.9-7c-0.1-5-6.8-6.2-6.9-6.2c-0.6-0.1-1-0.6-1-1.2c-0.6-10.1-9.9-12.2-10.3-12.3
		c-0.5-0.1-0.9-0.6-1-1.1C551.7,227,542.7,225.5,539.7,225.2L539.7,225.2z"/>
                                                <path id="Tracé_14620" class="st0-soja" d="M545.3,240.8c-1.6,0.1-3.2-0.7-4.1-2c-0.8-1.5-1.2-3.2-1-4.9c0.1-0.9,0.3-3.2,1.7-4.1
		c2-1.3,5.5-0.1,7.2,2.4l0,0c1.7,2.6,1.5,6.5-0.4,7.7C547.7,240.5,546.5,240.8,545.3,240.8z M543.8,231.8c-0.2,0-0.4,0-0.5,0.1
		c-0.5,0.5-1,3.9,0.1,5.5c0.9,1.4,3.2,0.9,4,0.4c0.5-0.3,0.8-2.5-0.3-4.3l0,0C546.3,232.5,545.1,231.9,543.8,231.8z"/>
                                                <path id="Tracé_14621" class="st0-soja" d="M555.8,253.8L555.8,253.8c-2,0-4-0.6-5.6-1.6c-1.6-1.1-2.7-2.8-3.1-4.7
		c-0.5-1.7-0.3-3.5,0.5-5c0.8-1.2,2.7-2.1,5.1-2.4c2.1-0.3,4.2,0.1,6,1.1c3.3,2.2,3.5,8.2,1.9,10.6C559.7,253,558,253.8,555.8,253.8
		z M554,242.5c-0.4,0-0.7,0-1.1,0.1c-1.2,0-2.4,0.5-3.3,1.3c-0.4,1-0.5,2-0.2,3c0.3,1.3,1,2.4,2.1,3.2c1.3,0.8,2.7,1.2,4.2,1.2
		c1,0.1,2-0.2,2.8-0.8c0.9-1.4,0.9-5.8-1.2-7.1C556.3,242.7,555.2,242.4,554,242.5L554,242.5z"/>
                                                <path id="Tracé_14622" class="st0-soja" d="M566.8,262.7c-0.9,0-1.7-0.2-2.5-0.7c-3.8-2.2-4.5-6.1-3.5-8c0.6-1,1.6-1.7,2.8-1.8
		c1.5-0.3,3.1,0.2,4.2,1.2c1.7,1.8,3.6,5.1,2.6,7.2l0,0c-0.5,0.9-1.3,1.6-2.3,1.9C567.7,262.6,567.3,262.7,566.8,262.7z
		 M564.4,254.6c-0.2,0-0.3,0-0.5,0c-0.3,0-0.7,0.2-0.9,0.4c-0.4,0.7-0.1,3.2,2.5,4.8c0.5,0.3,1.2,0.4,1.8,0.3
		c0.3-0.1,0.6-0.3,0.8-0.6l0,0c0.2-0.5-0.6-2.7-2.2-4.3C565.6,254.8,565,254.6,564.4,254.6L564.4,254.6z"/>
                                            </g>
</svg>
                                        <br> Soja
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('sesame', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="sesame">
                                        <svg version="1.1" id="sesame" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-sesame{fill:#FFFFFF;}
</style>
                                            <g id="Groupe_285" transform="translate(-851.609 -134.137)">
                                                <path id="Tracé_14614" class="st0-sesame" d="M889,159.9c-2.8,0-7.4-6.1-8.2-9.5l0,0c-0.5-1.9-0.4-3.8,0.3-5.6c0.6-1.7,2-3,3.8-3.4
		c3.3-0.8,6.8,2,7.8,6.2c0.8,3.5-0.7,11.7-3.3,12.3C889.2,159.8,889.1,159.9,889,159.9z M883.3,149.8c0.7,2.8,4.1,6.6,5.4,7.4
		c0.8-1.3,2.1-6.2,1.4-9c-0.7-2.8-2.8-4.7-4.6-4.3c-0.9,0.3-1.6,1-2,1.9C883,147,883,148.4,883.3,149.8L883.3,149.8z"/>
                                                <path id="Tracé_14615" class="st0-sesame" d="M898,167.4c-0.9,0-1.9-0.2-2.7-0.7c-1.5-1-2.5-2.6-2.5-4.4c-0.1-1.9,0.4-3.8,1.4-5.5
		c1.4-2,3.2-3.6,5.3-4.8c2.7-1.7,4.7-2.2,5.8-1.5s1.5,2.6,1.3,5.8c-0.1,2.4-0.8,4.8-1.9,6.9l0,0c-1,1.7-2.5,3-4.2,3.7
		C899.6,167.2,898.8,167.4,898,167.4z M903.8,152.7c-1.5,0.3-5.9,2.9-7.4,5.4c-0.7,1.2-1.1,2.5-1,3.9c-0.1,1.5,1.1,2.7,2.6,2.8
		c0.5,0,1-0.1,1.4-0.3c1.3-0.6,2.3-1.5,3-2.7l0,0C903.9,159.3,904.2,154.2,903.8,152.7L903.8,152.7z"/>
                                                <path id="Tracé_14616" class="st0-sesame" d="M887.5,184.4c-3.2,0-6-3.1-6.4-7.2c-0.1-2.4,0.4-4.8,1.3-7.1c1.2-3,2.4-4.6,3.7-4.7
		s2.8,1.2,4.5,3.9c1.4,2,2.3,4.3,2.7,6.7c0.4,4.3-2,8.1-5.3,8.4C887.8,184.4,887.7,184.4,887.5,184.4z M886.4,168.2
		c-1,1.2-2.9,5.9-2.7,8.7c0.3,2.8,2.1,5,4,4.9s3.3-2.7,3-5.5C890.4,173.4,887.6,169.1,886.4,168.2z"/>
                                                <path id="Tracé_14617" class="st0-sesame" d="M906,183.4c-1.6,0-3.1-0.4-4.5-1.2c-3.2-1.7-8.1-8.4-6.8-10.8c1.3-2.4,9.5-1.7,12.8,0
		c3.8,2.1,5.5,6.2,3.9,9.2c-0.9,1.6-2.5,2.6-4.3,2.7C906.7,183.4,906.4,183.4,906,183.4z M897.1,172.7c0.4,1.5,3.2,5.8,5.7,7.1
		c1.2,0.7,2.6,1,3.9,0.8c1-0.1,1.8-0.6,2.3-1.4c0.9-1.7-0.4-4.2-2.9-5.6l0,0C903.7,172.3,898.6,172.3,897.1,172.7z"/>
                                                <path id="Tracé_14618" class="st0-sesame" d="M870.9,170.3c-2.3,0-4.3-0.4-4.8-1.5c-1.4-2.4,3.5-9,6.7-10.9l0,0c3.8-2.1,8.2-1.5,9.9,1.5
		c0.8,1.6,0.9,3.5,0.1,5.1c-0.8,1.7-2.2,3.2-3.9,4.1C876.3,169.7,873.6,170.3,870.9,170.3z M868.5,167.4c1.5,0.4,6.6,0.3,9.1-1.1
		c1.2-0.7,2.2-1.7,2.8-2.9c0.5-0.8,0.5-1.9,0-2.7c-0.9-1.7-3.8-1.9-6.3-0.5l0,0C871.5,161.6,868.8,165.9,868.5,167.4L868.5,167.4z"
                                                />
                                            </g>
</svg>
                                        <br> Sésame
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('celery', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="celery">
                                        <svg version="1.1" id="celeri" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-celeri{fill:#FFFFFF;}
</style>
                                            <path id="Tracé_14605" class="st0-celeri" d="M51.3,19.3c-0.4-0.7-1.2-1-2-0.8c-1,0-1.9-0.5-2.4-1.3c-1-1.4-1.5-3.9,0.1-6.8
	c1.6-2.6,0.9-6-1.7-7.6c0,0-0.1-0.1-0.1-0.1c-1.8-1.1-3.8-0.9-4.7,0.4c-1.1,1.6-0.3,3.5,0.2,4.8c0.2,0.5,0.4,1,0.5,1.5
	c-0.5-0.1-0.9-0.3-1.3-0.5c-1.3-0.7-3.3-1.7-5.3-0.3c-2.2,1.6-2.2,5.3-2,7.5c-0.2-0.3-0.4-0.6-0.6-0.9c-0.2-0.3-0.3-0.7-0.5-1.1
	c-0.8-1.9-1.6-3.8-3.2-4.4c-0.9-0.3-1.9-0.1-2.7,0.4c-0.9,0.5-1.6,1.4-1.8,2.4c-0.2,1.7,0.2,3.4,1.1,4.8c-2.3-0.1-5.9,0-7.3,2
	c-0.8,1.1-0.8,2.5-0.1,4.2c0.4,1,1.2,1.7,2.2,2c0.6,0.2,1.3,0.2,1.9,0.1c-0.7,2.2-1.2,5.5,1,7.1c0.7,0.5,1.5,0.7,2.3,0.6
	c0.9-0.2,1.7-0.6,2.3-1.3c3.1,2.3,4.7,6,4.3,9.8c-1.2,10.4-0.2,16.1,2.9,17.2c0.9,1.6,2.8,2.2,4.5,1.5c3.3-1.3,6-7.3,4.5-14
	c-1.1-4.7-1.3-9.6-0.7-14.3c1.5,0.2,3,0,4.3-0.7c1-0.6,1.7-1.6,1.8-2.8c0-0.5-0.1-1.1-0.5-1.5c-0.7-0.7-1.8-0.8-2.9-0.8h-0.2
	c-2,0-2.7-0.2-2.9-1c0.3,0.1,0.6,0.2,0.9,0.2c0.5,0.2,1,0.3,1.5,0.4c2.4,0.3,4.7-0.8,5.9-2.9C51.4,22.1,52,20.4,51.3,19.3z
	 M38.2,58.9c-0.8,0.3-1.7,0-2.1-0.8c0.9-5.6,2.5-11.1,4.6-16.4c0.2,1.8,0.5,3.6,0.9,5.4C42.9,53.3,40.5,58,38.2,58.9z M48.8,22.6
	c-0.8,1.2-2.3,1.9-3.8,1.8c-0.5-0.1-0.9-0.2-1.3-0.3c-1.1-0.3-2.1-0.6-2.9,0c-0.5,0.5-0.7,1.2-0.5,1.8c0.4,2.7,3.2,2.7,4.9,2.7
	c0.6,0,1.1,0,1.7,0.1c0,0,0,0,0,0c0,0.5-0.3,1-0.8,1.2c-1.1,0.6-2.4,0.7-3.6,0.3c-0.5-0.2-1.1,0-1.3,0.5c0,0.1-0.1,0.1-0.1,0.2
	c-0.4,2.1-0.6,4.2-0.6,6.3c-1,2.2-1.8,4.3-2.5,6.2c-0.3-3.1-0.9-6.1-1.8-9.1c-2.6-9,3.6-17,3.7-17.1c0.3-0.4,0.3-1-0.2-1.4
	c-0.4-0.3-1-0.3-1.4,0.2l0,0c-2.7,3.6-4.3,7.8-4.7,12.2c-2-4.2-3.3-6.4-3.4-6.5c-0.3-0.5-0.9-0.6-1.3-0.3c-0.4,0.3-0.6,0.8-0.3,1.3
	c1.8,3.1,3.4,6.3,4.8,9.6c2.7,6.2,3,15.6,3,15.7c0,0,0,0.1,0,0.1c-0.9,2.8-1.6,5.7-2.1,8.6c-1-1.3-2-4.9-0.9-14.5
	c0.9-7.9-5.6-12-5.9-12.2c-0.4-0.3-1-0.2-1.3,0.3c-0.4,0.6-1,1-1.7,1.2c-0.3,0-0.6,0-0.9-0.2c-1.8-1.3-0.3-5.5,0.4-6.8
	c0.2-0.5,0-1.1-0.5-1.3c-0.3-0.1-0.7-0.1-0.9,0c-0.8,0.5-1.7,0.7-2.5,0.6c-0.5-0.2-0.8-0.5-1-1c-0.5-1-0.5-1.8-0.2-2.2
	c1.1-1.4,5.5-1.3,7.5-1c0.5,0.1,1-0.3,1.1-0.8c0-0.3,0-0.5-0.2-0.7c-0.6-0.8-2.1-3.4-1.8-5c0.1-0.5,0.4-0.9,0.8-1.1
	c0.7-0.4,1-0.3,1.1-0.2c0.8,0.3,1.5,1.9,2,3.3c0.2,0.4,0.3,0.8,0.5,1.1c1.5,3.3,3.7,2.7,3.8,2.7c0.5-0.1,0.8-0.6,0.7-1.1
	c-0.3-1.5-0.8-6.1,1-7.3c1-0.7,1.9-0.3,3.2,0.4c1,0.5,2.3,1.2,3.4,0.4c1.2-1,0.6-2.5,0.1-3.8c-0.5-1.3-0.8-2.3-0.4-3
	c0.3-0.4,1.2-0.4,2.1,0.1c1.3,0.8,2.4,2.6,1.1,5.1c-1.7,2.7-1.6,6.1,0.1,8.8c0.9,1.5,2.6,2.3,4.3,2.2c0,0,0.1,0,0.1,0
	C49.6,21.2,49.3,22,48.8,22.6L48.8,22.6z"/>
</svg>
                                        <br> Céleri
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('lupin', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="lupin">
                                        <svg version="1.1" id="lupin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-lupin{fill:#FFFFFF;}
</style>
                                            <path id="Tracé_14606" class="st0-lupin" d="M52.4,32.6c2.2-4,1-9-2.7-11.5c0.9-2.5,0.3-5.2-1.5-7.2c0.6-2.5-0.4-5.2-2.6-6.6
	C45.1,7,44.5,6.7,44,6.6c0,0,0,0,0,0s0,0,0,0c-1.2-0.2-2.4-0.2-3.5,0.1c-0.9-0.5-1.9-0.8-2.9-0.9h0c-0.1,0-0.2,0-0.4,0l0,0
	c-1.1,0-2.1,0.4-3,1c-1.1-0.3-2.2-0.3-3.4-0.1c0,0-0.1,0-0.1,0C30,6.7,29.5,7,29,7.3c-2.2,1.4-3.2,4.1-2.6,6.6
	c-1.8,1.9-2.4,4.7-1.5,7.2c-3.7,2.6-4.9,7.6-2.7,11.5c-3.5,3.3-4.2,8.7-1.5,12.8c2.2,3.5,7.3,6.6,11.7,6.6c0.2,0,0.4,0,0.5,0V53
	c0,2.3,1.8,4.1,4.1,4.1s4.1-1.8,4.1-4.1c0,0,0,0,0,0v-1.1c0.4,0.1,0.8,0.1,1.2,0.1c4.3,0,9.5-3,11.7-6.6C56.6,41.3,56,36,52.4,32.6z
	 M50.1,31.1c-0.1,0-0.2-0.1-0.3-0.1c-0.2-0.1-0.4-0.2-0.6-0.2c-0.2-0.1-0.3-0.1-0.5-0.1c-0.2-0.1-0.4-0.1-0.6-0.1
	c-0.2,0-0.3-0.1-0.5-0.1c-0.2,0-0.4-0.1-0.6-0.1c-0.2,0-0.3,0-0.5,0c-0.2,0-0.4,0-0.6,0c-0.1,0-0.2,0-0.3,0c0.2-0.8,0.3-1.6,0.3-2.5
	c0-1.1-0.2-2.1-0.6-3.2c-0.3-0.7-0.6-1.4-1-2c0.9-0.1,1.9,0,2.8,0.3c0,0,0,0,0.1,0c0.1,0.1,0.2,0.1,0.4,0.1c0.2,0.1,0.3,0.2,0.5,0.3
	c0,0,0.1,0,0.1,0.1C50.6,25.1,51.4,28.4,50.1,31.1L50.1,31.1z M38.8,48.8L38.8,48.8c-0.2,0.1-0.3,0.2-0.5,0.3
	c-1,0.5-2.3,0.5-3.3-0.1c0,0,0,0,0,0l0,0l0,0l0,0c-2.7-1.6-4.5-6.3-4.5-9.7c0-0.7,0.1-1.3,0.3-1.9c0.3-1.1,0.9-2.2,1.6-3.1
	c0.2-0.2,0.4-0.4,0.6-0.6l0,0c1.1-1,2.4-1.5,3.9-1.6l0,0l0.1,0c0.2,0,0.4,0,0.6,0l0.1,0l0,0c1.4,0.1,2.8,0.7,3.9,1.6l0,0
	c0.1,0.1,0.3,0.3,0.4,0.4c0.9,0.9,1.5,2.1,1.8,3.3c0.2,0.6,0.2,1.3,0.3,1.9C44.1,42.7,41.6,47.1,38.8,48.8z M27.5,20
	c-0.5-1.7,0-3.5,1.3-4.6l0,0c0.1-0.1,0.2-0.1,0.3-0.2c0.6-0.4,1.4-0.6,2.2-0.6c-0.5,1-0.9,2.1-0.9,3.2c0,0,0,0,0,0s0,0,0,0
	c0,0.2,0,0.3,0,0.5c0,0.5,0,1,0.1,1.5C29.5,19.8,28.5,19.8,27.5,20L27.5,20z M35.3,9.3c0.5-0.5,1.2-0.7,1.9-0.7l0,0l0.1,0l0.1,0l0,0
	c0.7,0,1.3,0.3,1.9,0.7c0,0,0,0,0.1,0s0,0,0.1,0.1c0.4,0.4,0.7,0.8,0.9,1.3l0,0c0.2,0.4,0.2,0.8,0.3,1.3c-1-0.5-2-0.8-3.1-0.9h0
	c-0.1,0-0.1,0-0.2,0l0,0c-1.1,0-2.2,0.3-3.2,0.9c0-0.4,0.1-0.9,0.3-1.3l0,0C34.5,10.2,34.8,9.7,35.3,9.3C35.2,9.4,35.2,9.3,35.3,9.3
	C35.2,9.3,35.3,9.3,35.3,9.3L35.3,9.3z M44.1,19.8c0.1-0.5,0.1-1,0.2-1.4c0-0.1,0-0.3,0-0.5v0l0,0v0l0,0l0,0c0-0.3-0.1-0.5-0.1-0.8
	c0-0.1,0-0.1,0-0.2c0-0.3-0.1-0.5-0.2-0.8l0,0c-0.1-0.2-0.2-0.5-0.3-0.7c0-0.1,0-0.1-0.1-0.2s-0.1-0.1-0.1-0.2
	c0.7-0.2,1.5-0.1,2.1,0.3c0.1,0,0.1,0.1,0.2,0.1l0,0c1.3,1.1,1.9,2.9,1.4,4.5C46.1,19.7,45.1,19.7,44.1,19.8L44.1,19.8z M37.9,29.2
	L37.9,29.2l-0.1,0c-0.3,0-0.7,0-1,0l-0.1,0l0,0c-1.7,0.1-3.3,0.7-4.7,1.7c-0.3-1-0.4-2-0.5-3c0-0.8,0.1-1.5,0.4-2.2
	c0.3-0.9,0.9-1.8,1.6-2.5l0.1-0.1c0.9-0.8,2.1-1.3,3.4-1.4l0,0l0.2,0c0.1,0,0.2,0,0.3,0l0.2,0c1.3,0.1,2.4,0.6,3.4,1.4l0,0h0l0,0
	c0.8,0.7,1.4,1.6,1.7,2.6c0.3,0.7,0.4,1.5,0.4,2.2c0,1-0.2,2-0.6,2.9C41.1,29.8,39.5,29.3,37.9,29.2L37.9,29.2z M37.2,13.9
	L37.2,13.9c1,0,2,0.4,2.7,1l0,0c0.2,0.2,0.3,0.3,0.5,0.5l0,0c0.6,0.7,1,1.7,1,2.6c0,0,0,0,0,0l0,0c0,0.1,0,0.2,0,0.3
	c0,0.2,0,0.5,0,0.7c0,0.1,0,0.1,0,0.2c0,0.2-0.1,0.3-0.1,0.5c0,0,0,0,0,0c-0.2-0.1-0.5-0.2-0.7-0.3c-0.1,0-0.1,0-0.2-0.1
	c-0.2-0.1-0.5-0.2-0.7-0.2c0,0-0.1,0-0.1,0c-0.3-0.1-0.5-0.1-0.8-0.2c-0.1,0-0.1,0-0.2,0c-0.3,0-0.5-0.1-0.8-0.1l-0.1,0
	c-0.2,0-0.4,0-0.7,0l-0.1,0l0,0c-0.3,0-0.6,0-0.8,0.1c-0.1,0-0.2,0-0.2,0c-0.2,0-0.4,0.1-0.6,0.1c-0.1,0-0.2,0-0.2,0.1
	c-0.3,0.1-0.5,0.2-0.7,0.3l0,0c-0.3,0.1-0.5,0.2-0.7,0.4c0,0-0.1,0-0.1,0c0-0.2-0.1-0.4-0.1-0.5c0-0.1,0-0.1,0-0.2
	c0-0.2,0-0.5,0-0.7c0-0.1,0-0.2,0-0.3V18l0,0c0.1-0.9,0.4-1.8,0.9-2.5l0,0c0.2-0.2,0.4-0.4,0.6-0.6l0,0
	C35.4,14.3,36.3,13.9,37.2,13.9L37.2,13.9z M43.4,12.2C43.4,12.2,43.4,12.1,43.4,12.2c0-0.9-0.2-1.8-0.5-2.6l0,0
	c-0.1-0.1-0.1-0.2-0.2-0.4c0.2,0,0.3,0,0.5,0.1c0.3,0.1,0.6,0.2,0.8,0.4c0.9,0.6,1.4,1.6,1.5,2.6C44.8,12.1,44.1,12.1,43.4,12.2
	L43.4,12.2z M30.5,9.7c0.2-0.2,0.5-0.3,0.8-0.3c0.1,0,0.3,0,0.5-0.1c-0.1,0.1-0.1,0.2-0.2,0.3l0,0c-0.1,0.2-0.1,0.4-0.2,0.6
	c0,0.1,0,0.1-0.1,0.2c0,0.1-0.1,0.3-0.1,0.4c0,0.1,0,0.2,0,0.2c0,0.1,0,0.2-0.1,0.4c0,0.1,0,0.2,0,0.3c0,0.1,0,0.1,0,0.2
	c-0.7,0-1.5,0.1-2.1,0.4C29.1,11.2,29.6,10.2,30.5,9.7L30.5,9.7z M26.4,23.4c0.2-0.1,0.5-0.3,0.7-0.4c1-0.3,2-0.5,3-0.4
	c-0.4,0.6-0.8,1.3-1,2c-0.4,1-0.5,2.1-0.5,3.2c0,0.4,0,0.8,0.1,1.2c0,0.1,0,0.3,0.1,0.4c0,0.3,0.1,0.5,0.1,0.8c0,0,0,0,0,0.1
	c-0.1,0-0.2,0-0.3,0c-0.2,0-0.4,0-0.6,0c-0.2,0-0.3,0-0.5,0c-0.2,0-0.4,0-0.6,0.1c-0.2,0-0.3,0.1-0.5,0.1c-0.2,0-0.4,0.1-0.6,0.1
	c-0.2,0-0.3,0.1-0.5,0.1c-0.2,0.1-0.4,0.1-0.6,0.2c-0.1,0-0.2,0.1-0.3,0.1C23.1,28.4,24,25.1,26.4,23.4L26.4,23.4z M23,43.9
	c-2.1-3.2-1.4-7.5,1.8-9.7l0,0c0,0,0.1,0,0.1-0.1c1.4-0.9,3.1-1.2,4.7-0.9c-0.7,1-1.3,2.2-1.6,3.4c-0.2,0.9-0.3,1.7-0.3,2.6
	c0,0.4,0,0.7,0,1.1c0,0.1,0,0.2,0,0.3c0,0.3,0.1,0.7,0.1,1c0,0,0,0.1,0,0.1c0.1,0.4,0.1,0.8,0.2,1.1c0,0.1,0,0.2,0.1,0.3
	c0.1,0.3,0.2,0.7,0.3,1c0,0.1,0,0.1,0.1,0.2c0.1,0.4,0.3,0.7,0.4,1.1c0,0.1,0.1,0.2,0.1,0.3c0.1,0.3,0.3,0.6,0.4,0.9
	c0,0.1,0.1,0.1,0.1,0.2c0.2,0.3,0.4,0.7,0.6,1c0,0.1,0.1,0.1,0.1,0.2c0.2,0.3,0.4,0.5,0.5,0.8c0,0,0.1,0.1,0.1,0.1
	C27.7,48.4,24.9,46.5,23,43.9L23,43.9z M38.2,53c0,0.7-0.5,1.3-1.2,1.3c-0.7,0-1.3-0.5-1.3-1.2c0,0,0,0,0-0.1v-0.8
	c0.1,0,0.1,0,0.2,0c0.1,0,0.2,0,0.3,0c0.2,0,0.3,0,0.5,0c0.1,0,0.1,0,0.2,0c0,0,0.1,0,0.1,0c0.3,0,0.5,0,0.8-0.1c0,0,0.1,0,0.1,0
	c0.2,0,0.4-0.1,0.5-0.1L38.2,53z M51.6,43.9c-2,2.9-5.2,4.8-8.8,5.2l0,0c0.3-0.3,0.5-0.6,0.8-0.9c0.1-0.1,0.1-0.2,0.2-0.2
	c0.2-0.3,0.4-0.6,0.6-0.9c0,0,0-0.1,0.1-0.1c0.2-0.3,0.4-0.7,0.6-1.1c0-0.1,0.1-0.2,0.1-0.3c0.2-0.3,0.3-0.7,0.5-1.1
	c0,0,0-0.1,0-0.1c0.2-0.4,0.3-0.8,0.4-1.1c0-0.1,0.1-0.2,0.1-0.3c0.1-0.4,0.2-0.8,0.3-1.1c0,0,0,0,0,0c0.1-0.4,0.1-0.8,0.2-1.2
	c0-0.1,0-0.2,0-0.3c0-0.4,0.1-0.8,0.1-1.1c0-0.9-0.1-1.8-0.3-2.6c-0.3-1.2-0.8-2.4-1.6-3.4c1.6-0.3,3.3,0,4.7,0.8
	c0,0,0.1,0.1,0.1,0.1C52.9,36.4,53.7,40.7,51.6,43.9L51.6,43.9z"/>
</svg>
                                        <br> Lupin
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('milk', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="milk">
                                        <svg version="1.1" id="lait" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-lait{fill:#FFFFFF;}
</style>
                                            <path id="Tracé_14599" class="st0-lait" d="M49.4,20c0-0.1,0-0.1,0-0.2c0,0,0,0,0,0c0-0.1,0-0.2-0.1-0.2c0,0,0,0,0,0
	c0-0.1-0.1-0.1-0.1-0.2c0,0,0,0-0.1-0.1c0,0-0.1-0.1-0.1-0.1l-6.2-5.8V8.8c0-0.6-0.5-1.2-1.1-1.2L26.2,6.4c-0.7,0-1.3,0.5-1.3,1.1
	c0,0,0,0.1,0,0.1v4.6l-5.4,7.2c0,0,0,0,0,0c-0.1,0.1-0.1,0.2-0.1,0.3c0,0,0,0.1,0,0.1c0,0.1,0,0.1-0.1,0.2c0,0,0,0.1,0,0.1
	s0,0.1,0,0.1v31.4c0,0.6,0.4,1.1,1,1.2l16.6,3.7c0.2,0,0.3,0,0.5,0c0,0,0,0,0.1,0c0.1,0,0.1,0,0.2,0l0,0l11.1-4.6
	c0.5-0.2,0.8-0.6,0.8-1.1L49.4,20C49.4,20,49.4,20,49.4,20z M45.4,19.1l-6,0.8l2.4-4.2L45.4,19.1z M40.3,10v2.5l-13-1V9L40.3,10z
	 M26.7,14l12.8,0.9l-3.1,5.3l-13.6-1.1L26.7,14z M21.7,21.5l13.1,1.1l1,0.1v31l-14.1-3.1L21.7,21.5z M46.9,49.8l-8.6,3.6V22.6
	l8.6-1.2V49.8z"/>
</svg>
                                        <br>Produits laitiers
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('mustard', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="mustard">
                                        <svg version="1.1" id="moutarde" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-moutarde{fill:#FFFFFF;}
</style>
                                            <g id="Groupe_282" transform="translate(-313.447 -210.127)">
                                                <path id="Tracé_14597" class="st0-moutarde" d="M359.6,230.4v-1.6c0-2.4-1.9-4.3-4.3-4.3h-0.7l-1.1-7.9c-0.1-0.6-0.6-1.1-1.2-1.1h-3
		c-0.6,0-1.1,0.5-1.2,1.1l-1.1,7.9h-1.1c-2.4,0-4.3,1.9-4.3,4.3v1.7c-1.7,0.6-2.9,2.3-2.9,4.1v26.6c0,2.4,1.9,4.3,4.3,4.3h15.6
		c2.4,0,4.3-1.9,4.3-4.3v-26.6C362.8,232.7,361.5,230.9,359.6,230.4z M350.3,218h0.8l0.9,6.5h-2.6L350.3,218z M345.8,227h9.4
		c1,0,1.9,0.8,1.9,1.9v1.4H344v-1.4C344,227.9,344.8,227,345.8,227L345.8,227z M360.4,261.2c0,1-0.8,1.9-1.9,1.9h-15.6
		c-1,0-1.9-0.8-1.9-1.9v-26.6c0-1,0.8-1.9,1.9-1.9h15.6c1,0,1.9,0.8,1.9,1.9V261.2z"/>
                                                <path id="Tracé_14598" class="st0-moutarde" d="M356.4,235.6h-11.7c-0.6,0-1.1,0.7-1.1,1.5v18.6c0,0.8,0.5,1.5,1.1,1.5h11.7
		c0.6,0,1.1-0.7,1.1-1.5v-18.6C357.5,236.3,357,235.6,356.4,235.6z M355.3,254.2h-9.5v-15.7h9.5V254.2z"/>
                                            </g>
</svg>
                                        <br> Moutarde
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('sulfite', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="sulfite">
                                        <svg version="1.1" id="sulfite" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 74.6 62.9" style="enable-background:new 0 0 74.6 62.9;" xml:space="preserve">
<style type="text/css">
    .st0-sulfite{fill:#FFFFFF;}
</style>
                                            <g id="Groupe_283" transform="translate(-653.585 -118.186)">
                                                <path id="Tracé_14600" class="st0-sulfite" d="M715.4,167C715.4,167,715.3,166.9,715.4,167l-16.7-23.2v-10.9c1.2-0.9,1.9-2.3,1.9-3.8V129
		c0-2.6-2.1-4.7-4.7-4.7h-10.4c-2.6,0-4.7,2.1-4.7,4.7v0.2c0,1.4,0.7,2.8,1.8,3.7v11L666.4,167l0,0.1c-1,1.5-1.1,3.5-0.3,5.1
		c0.8,1.6,2.3,2.6,4,2.8c0.2,0,0.3,0,0.5,0h40.6c0.2,0,0.3,0,0.5,0c1.7-0.2,3.3-1.2,4-2.8C716.5,170.5,716.4,168.5,715.4,167z
		 M685.5,145.3c0.2-0.3,0.3-0.6,0.3-0.9v-12.4c0-0.6-0.4-1.2-0.9-1.5c-0.5-0.2-0.8-0.8-0.9-1.3V129c0-0.8,0.7-1.5,1.5-1.5h10.4
		c0.8,0,1.5,0.7,1.5,1.5v0.2c0,0.6-0.4,1.1-0.9,1.4c-0.6,0.2-1,0.8-1,1.5v12.3c0,0.3,0.1,0.7,0.3,0.9l6.7,9.3H679L685.5,145.3z
		 M712.8,170.7c-0.3,0.6-0.8,1-1.4,1c-0.1,0-0.1,0-0.2,0h-40.6c-0.1,0-0.1,0-0.2,0c-0.6-0.1-1.2-0.4-1.4-1c-0.3-0.6-0.3-1.4,0.1-2
		l7.7-11h28c0,0,0,0,0,0l7.9,11C713.1,169.4,713.1,170.1,712.8,170.7L712.8,170.7z"/>
                                                <path id="Tracé_14601" class="st0-sulfite" d="M686,163.5l-1-0.4c-0.3-0.1-0.5-0.2-0.7-0.3c-0.1-0.1-0.2-0.1-0.3-0.2
		c-0.1-0.1-0.1-0.2-0.1-0.3c0-0.2,0.1-0.3,0.2-0.4c0.4-0.2,1-0.2,1.4,0c0.3,0.1,0.5,0.3,0.7,0.4l0.1,0.1l1-1.2l-0.1-0.1
		c-1-1-2.6-1.3-3.9-0.7c-0.4,0.2-0.7,0.5-1,0.8c-0.2,0.4-0.4,0.8-0.4,1.2c0,0.5,0.1,1,0.5,1.4c0.3,0.4,0.7,0.6,1.1,0.8l1,0.4
		c0.3,0.1,0.5,0.2,0.6,0.3c0.1,0.1,0.2,0.1,0.3,0.2c0.1,0.1,0.1,0.2,0.1,0.3c0,0.2-0.1,0.4-0.2,0.5c-0.5,0.3-1.1,0.2-1.7,0
		c-0.3-0.1-0.6-0.3-0.9-0.6l-0.1-0.1l-1.1,1.3l0.1,0.1c0.4,0.4,0.8,0.7,1.3,0.8c0.5,0.2,1,0.3,1.5,0.3c0.5,0,1.1-0.1,1.6-0.3
		c0.4-0.2,0.8-0.5,1-0.9c0.2-0.4,0.4-0.8,0.4-1.2c0-0.5-0.1-1-0.4-1.3C686.8,164,686.4,163.7,686,163.5z"/>
                                                <path id="Tracé_14602" class="st0-sulfite" d="M693.6,160.5c-1.1-0.6-2.5-0.6-3.7,0c-0.5,0.3-1,0.8-1.2,1.4c-0.3,0.7-0.5,1.4-0.4,2.1
		c0,0.7,0.1,1.5,0.4,2.2c0.3,0.6,0.7,1.1,1.2,1.4c1.1,0.7,2.5,0.7,3.7,0c0.5-0.3,1-0.8,1.2-1.4c0.3-0.7,0.5-1.4,0.4-2.2
		c0-0.7-0.1-1.5-0.4-2.1C694.5,161.4,694.1,160.9,693.6,160.5z M693.3,164.1c0,0.6-0.1,1.2-0.4,1.8c-0.4,0.6-1.3,0.8-1.9,0.4
		c-0.2-0.1-0.3-0.2-0.4-0.4c-0.3-0.5-0.5-1.1-0.4-1.8c0-0.6,0.1-1.2,0.4-1.7c0.5-0.6,1.3-0.8,2-0.3c0.1,0.1,0.2,0.2,0.3,0.3
		C693.2,162.9,693.3,163.5,693.3,164.1L693.3,164.1z"/>
                                                <path id="Tracé_14603" class="st0-sulfite" d="M698.5,168.3c0.9-0.4,1.3-0.8,1.3-1.6c0-0.6-0.4-1.6-1.9-1.6c-1-0.1-1.9,0.7-2,1.7
		c0,0,0,0,0,0l0,0.2l1.5,0l0-0.1c0.1-0.5,0.4-0.5,0.5-0.5c0.3,0,0.4,0.1,0.4,0.3c0,0.2-0.1,0.3-0.7,0.6l-0.2,0.1
		c-0.9,0.4-1.5,1.3-1.5,2.3v0.2h3.9l0.2-1.3h-2.1C698,168.6,698.2,168.4,698.5,168.3z"/>
                                            </g>
</svg>
                                        <br> Sulfite
                                    </button>
                                </div>
                                <textarea name="allergy" class="textarea-allergy"
                                          id="textarea-allergy">@if(isset($allergy)) {{ implode('|', $allergy) }} @endif</textarea>
                            </div>

                            <div class="floating-label">
                                <input type="checkbox" value="1" name="homemade" id="homemade">
                                <label for="homemade" class="mout--regular check">Fait maison</label>
                            </div>
                            <div class="button-container text-center">
                                <button type="submit" class="btn mout-btn-login">
                                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Enregistrer
                                </button>

                                <button type="button" class="btn mout-btn-add close-product-form">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/middle-admin/users-manager.js') }}"></script>
    <script src="{{ asset('/js/plugins/add-media.js') }}"></script>
    <script src="{{ asset('js/admin/manage-allergy.js') }}"></script>
    <script src="{{ asset('js/admin/manage-product-admin.js') }}"></script>
    <script src="{{ asset('js/middle-admin/product-creation-middle-manager.js') }}"></script>
    <script>
        $(document).ready(function () {
            @isset( request()->productId )
                setTimeout(function () {
                    $('.foodcard-edit-product[data-value="{{ request()->productId }}"]').trigger('click');

            }, 10);
            @endisset

            $('.images').addMedia({
                width: '300px',
                height: '300px',
                onDelete: function (url) {
                    //Ici on fait l'ajax pour supprimer
                }
            });

            matable = $('.table-starters').DataTable({
                "search": {
                    "placeholder": ""
                }

            });

            $('.btn-my-menu').on('click', function () {
               $('.my-menu-creation-container').addClass('active');

               $('.close-product-form').on('click', function () {
                   $('.my-menu-creation-container').removeClass('active');
               })
            });

            $(".office").on("click", function () {
                val = $(this).data("value");
                matable.search(val).draw();
                // matable.columns(1).search(val).draw();

            });

            $('body').on('click', '.foodcard-edit-product', function () {
                let idProduct = $(this).attr("data-value");
                let formContainer = $('.my-menu-creation-container');

                $('#edit-product-form')[0].reset();
                $('.product_edit_block').remove();
                formContainer.addClass('active');

                $('.close-product-form').on('click', function () {
                    formContainer.removeClass('active');
                })

                $.post('/admin-client/ma-carte/product/update', { "idProduct" : idProduct}, function (result) {

                    $.each(result.locales, function (i, v) {

                        $('input.product_label_' + i).val(v.libelle);
                        $('textarea.product_description_' + i).val(v.description);
                    });

                    $.each(result.images, function (i, v) {
                        let container = $('.add-media-block');
                        let imgcontent = $('<div>').addClass('add-media-block').addClass('product_edit_block');
                        let img = $('<img>').addClass('add-media-preview-img').addClass('img-fluid').attr('src', 'http://mymenu.local/storage/products/' + v.path);
                        let input = $('<input>').attr('type', 'file').attr('name', 'image[]').attr('accept', 'image/*');
                        let removeBlock = $('<span>').addClass('mout--regular').addClass('add-media-remove').text('remove').click(function () {
                            $(this).parent().remove();
                        });

                        container.before(imgcontent);
                        imgcontent.prepend(img);
                        img.before(input).after(removeBlock);
                    });

                    $('input.product_price').val(result.price);
                    $('input.product_buy_price').val(result.buy_price);
                    $('input.product_special_price').val(result.special_price);

                    $.each(result.allergy.split('|'), function (i, v) {
                       $('.btn-allergy[data-allergy='+v+']').removeClass('btn-allergy-inactive').addClass('btn-allergy-active');
                    });
                });
            });

        });
    </script>
@endsection
