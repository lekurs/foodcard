@extends('layouts.admin-layout')

@section('title', 'Utilisateurs')

@section('body')
    <div class="mout-bo-section-container">
        <div class="mout-bo-top-search-bar">
            <form action="#">
                <div class="floating-label">
                    <input type="text" class="floating-input" placeholder=" " name="search-shop" id="search-shop">
                    <label for="search-shop" class="float">Magasins</label>
                    <span class="highlight"></span>
                </div>

                <div class="select floating-label">
                        <select name="type-shop" id="type-shop" class="select-hidden custom-select">
                            <option value="hide">Type de magasin</option>
                            @foreach($storeTypes as $storeType)
                            <option value="{{$storeType->id}}">{{$storeType->type}}</option>
                            @endforeach
                        </select>
                </div>

                <a href="#" class="btn mout-btn-add">
                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span>
                    Chercher
                </a>
            </form>
        </div>
    </div>

    <div class="mout-bo-section">
        <div class="mout-bo-shop-container">
            @include('layouts.storecards.usercards')
        </div>
    </div>

@endsection
