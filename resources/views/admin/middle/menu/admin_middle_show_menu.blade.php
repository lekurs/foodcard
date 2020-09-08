@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
            {{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

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
        <a href="{{ route('adminMiddleStoreShow') }}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
        <a href="{{ route('adminMiddleAccountShow') }}" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel text-center">
        <div class="my-menu-container">
            {{-- Starters--}}
            <table id="starters" class="table table-hover mout-bo-table table-starters">
                <thead>
                <tr>
                    <th>{{ $starters->catalogueCategoryLocales()->first()->libelle }}</th>
                    <th>Type</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    <th>En ligne</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="mout-add-element-table" colspan="7">
                        <a href="{{ route('editMenu', $starters->id) }}" class="mout-btn-login mout--regular">Ajouter une entrée</a>
                    </td>
                </tr>
                @foreach($starters->products as $product)
                    @if ( !is_null($product->stores->first()) )
                    <tr>
                        <td>@if(!is_null($product->catalogueProductMedias->first))
                                <img src="{{ asset('storage/products/' . $product->catalogueProductMedias->first()->path) }}"
                                     class="img-fluid mout-table-img" alt="{{ $product->langueFR->libelle }}">
                            @else <i class="fal fa-image fa-2x"></i>
                            @endif
                        </td>
                        <td>
                            @foreach($product->categories as $category)
                                @if(!is_null($category->parent))
                                    {{ $category->catalogueCategoryLocales->first()->libelle }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $product->langueFR->libelle }}</td>
                        <td>{!! $product->langueFR->description !!}</td>
                        <td><a href="{{ route('editMenu', [$starters->id, $product->id]) }}" class="btn mout-btn-login dflex flex-row" data-product-id="{{ $product->id }}">Modifier <i class="far fa-magic ml-3"></i></a></td>
                        <td><i class="far fa-trash-alt" style="font-size: 1.5em"></i></td>
                        <td class="online-menu" data-product="{{ $product->id }}">
                            @if($product->stores->first()->pivot->online > 0)
                                <i class="fal fa-minus-circle online"></i>
                            @else
                                <i class="fal fa-plus-circle offline"></i>
                            @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <table id="mainDishes" class="table table-hover mout-bo-table table-starters">
                <thead>
                <tr>
                    <th>{{ $mainDishes->catalogueCategoryLocales()->first()->libelle }}</th>
                    <th>Type</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    <th>En ligne</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="mout-add-element-table" colspan="7">
                        <a href="#" class="mout-btn-edit-middle mout--regular">Ajouter un plat</a>
                    </td>
                </tr>
                @foreach($mainDishes->products as $product)
                <tr>
                    <td>@if(!is_null($product->catalogueProductMedias->first))
                            <img
                                src="{{ asset('storage/products/' . $product->catalogueProductMedias->first()->path) }}"
                                class="img-fluid mout-table-img"
                                alt="{{ $product->langueFR->libelle }}">
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
                    <td><a href="{{ route('editMenu', [$mainDishes->id, $product->id]) }}"
                           class="btn mout-btn-login dflex flex-row"
                           data-product-id="{{ $product->id }}">Modifier <i
                                class="far fa-magic ml-3"></i></a></td>
                    <td><i class="far fa-trash-alt" style="font-size: 1.5em"></i></td>
                    <td class="online-menu" data-product="{{ $product->id }}">
                        @if($product->stores->first()->pivot->online > 0)
                            <i class="fal fa-minus-circle online"></i>
                        @else
                            <i class="fal fa-plus-circle offline"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
{{--            desert--}}
            <table id="deserts" class="table table-hover mout-bo-table table-starters">
                <thead>
                <tr>
                    <th>{{ $deserts->catalogueCategoryLocales()->first()->libelle }}</th>
                    <th>Type</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    <th>En ligne</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="mout-add-element-table" colspan="7">
                        <a href="#" class="mout-btn-add-middle mout--regular">Ajouter un dessert</a>
                    </td>
                </tr>
                @foreach($deserts->products as $product)
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
                        <td><a href="{{ route('editMenu', [$deserts->id, $product->id]) }}"
                               class="btn mout-btn-login dflex flex-row" data-product-id="{{ $product->id }}">Modifier
                                <i class="far fa-magic ml-3"></i></a></td>
                        <td><i class="far fa-trash-alt" style="font-size: 1.5em"></i></td>
                        <td class="online-menu" data-product="{{ $product->id }}">
                            @if($product->stores->first()->pivot->online > 0)
                                <i class="fal fa-minus-circle online"></i>
                            @else
                                <i class="fal fa-plus-circle offline"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            drinks
            <table id="drinks" class="table table-hover mout-bo-table table-drinks">
                <thead>
                <tr>
                    <th>{{ $drinks->catalogueCategoryLocales()->first()->libelle }}</th>
                    <th>Type</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    <th>En ligne</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="mout-add-element-table" colspan="7">
                        <a href="#" class="mout-btn-drink mout--regular">Ajouter une boisson</a>
                    </td>
                </tr>
                @foreach($drinks->products as $product)
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
                        <td><a href="{{ route('editMenu', [$drinks->id, $product->id]) }}"
                               class="btn mout-btn-login dflex flex-row" data-product-id="{{ $product->id }}">Modifier
                                <i class="far fa-magic ml-3"></i></a></td>
                        <td><i class="far fa-trash-alt" style="font-size: 1.5em"></i></td>
                        <td class="online-menu" data-product="{{ $product->id }}">
                            @if($product->stores->first()->pivot->online > 0)
                                <i class="fal fa-minus-circle online"></i>
                            @else
                                <i class="fal fa-plus-circle offline"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>
    <script>
        $(document).ready(function () {
            //     $('#starters').dataTable({
            //
            //     }) ;
            //
            //     $('#mainDishes').dataTable({
            //
            //     });
            //
            //     $('#deserts').dataTable({
            //
            //     });
            //
            //     $('#drinks').dataTable({
            //
            //     });
            // });

            $('body').on('click', 'td.online-menu', function () {
                let productId = $(this).attr('data-product');
                let elt = $(this);
                $.post('/admin-client/ma-carte/product/online/update', {"idProduct": productId}, function (result) {
                    let picto = elt.find('i');

                    if (picto.hasClass('fa-plus-circle')) {
                        picto.removeClass('fa-plus-circle').removeClass('offline').addClass('fa-minus-circle').addClass('online');
                    } else {
                        picto.removeClass('fa-minus-circle').removeClass('online').addClass('fa-plus-circle').addClass('offline');
                    }
                });
            });
        });
    </script>
@endsection
