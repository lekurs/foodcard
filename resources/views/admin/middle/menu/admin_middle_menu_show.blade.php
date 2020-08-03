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
                <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
                <a href="{{route('adminMiddleAccountShow')}}" class="btn mout-admin-middle-nav-buttons btn-account"><i class="fal fa-smile"></i></a>
            </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel text-center">
        <div class="my-menu-container">
            <a href="#" class="btn btn-search-menu btn-my-menu mout--regular"><span class="btn-my-menu-icon-container"><i class="fal fa-search"></i></span>Je recherche</a>
            <button class="btn btn-create-menu btn-my-menu mout--regular" data-toggle="modal" data-target="#productCreation"><span class="btn-my-menu-icon-container"><i class="fal fa-bell"></i></span>Je crée </button>
            <a href="#" class="btn btn-create-menu btn-my-menu mout--regular"><span class="btn-my-menu-icon-container"><i class="fal fa-concierge-bell"></i></span>Voir ma carte</a>
            <a href="#" class="btn btn-create-menu btn-my-menu mout--regular"><span class="btn-my-menu-icon-container"><i class="fal fa-hat-chef"></i></span>Créer ma<br>formule</a>
        </div>

        <p class="my-menu-search-wording mout--regular">Rechercher par catégories</p>

        <div class="my-menu-container" id="category-menu">
            @foreach($categories as $category)
                <a href="#" class="btn btn-search-menu btn-my-category mout--regular" id="{{$category->slug}}" style="{{$category->color}}" data-category="{{$category->catalogue_category_id}}"><span class="btn-my-menu-icon-container">{!! $category->icon !!}</span>{{$category->libelle}}</a>
            @endforeach
        </div>

        <div class="my-submenu-category-container">

        </div>
    </div>

    <div class="products-table-container">
        <table class="table mout-table products-table">
            <thead>
            <tr>
                <th>entrées</th>
                <th>type</th>
                <th>libellé</th>
                <th>action</th>
                <th></th>
            </tr>
            <tbody>
            <tr>
                <td>@isset($product)<img src="{{asset('images/entree-froide.jpg')}}" alt="" class="img-fluid product-table-img-mini">@endisset <i class="fal fa-image fa-2x"></i></td>
                <td>Entrée froide</td>
                <td>Salade César</td>
                <td><a href="#" class="btn mout-btn-login" data-product="">Renseigner ce plat</a></td>
                <td><i class="fal fa-eye fa-2x"></i></td>
            </tr>
            <tr>
                <td><img src="{{asset('images/entree-froide.jpg')}}" alt="" class="img-fluid product-table-img-mini"></td>
                <td>Entrée froide</td>
                <td>Salade César</td>
                <td><a href="#" class="btn mout-btn-login" data-product="">Renseigner ce plat</a></td>
                <td class="product-table-icon-container"><i class="fal fa-eye fa-2x"></i></td>
            </tr>
            </tbody>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productCreation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mout--regular" id="staticBackdropLabel">Choisissez votre catégorie de produit à ajouter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="my-menu-container" id="category-menu-modal">
                        @foreach($categories as $category)
                            <a href="{{route('adminMiddleMenuCreateShow', $category->slug)}}" class="btn btn-search-menu btn-my-category mout--regular" id="{{$category->slug}}" style="{{$category->color}}"><span class="btn-my-menu-icon-container">{!! $category->icon !!}</span>{{$category->libelle}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>
    <script src="{{asset('js/middle-admin/subcategory-manager.js')}}"></script>
@endsection
