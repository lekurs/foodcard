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
                                            data-allergy="crustace"><i class="fal fa-fish"></i><br> Crustacé
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('mollusque', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="mollusque"><i class="fal fa-fish"></i><br> Mollusque
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('gluten', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="gluten"><i class="fal fa-wheat"></i><br> Gluten
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('arachides', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="arachides"><i class="fal fa-wheat"></i><br> Arachides
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('nutts', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="nutts"><i class="fal fa-acorn"></i><br> Fruits à coque
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('soja', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="soja"><i class="fal fa-acorn"></i><br> Soja
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('sesame', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="sesame"><i class="fal fa-acorn"></i><br> Sésame
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('celery', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="celery"><i class="fal fa-fish"></i><br> Céleri
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('lupin', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="lupin"><i class="fas fa-wheat"></i><br> Lupin
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('milk', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="milk"><i class="fal fa-jug"></i> <br>Produits laitiers
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('mustard', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="mustard"><i class="fal fa-fish"></i><br> Moutarde
                                    </button>
                                    <button type="button"
                                            class="btn @if(isset($allergy) && in_array('sulfite', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy"
                                            data-allergy="sulfite"><i class="fal fa-fish"></i><br> Sulfite
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
                    "placeholder": "Fred"
                }

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
