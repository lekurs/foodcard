@extends('layouts.admin-layout')

@section('title', 'Magasins')

@section('body')
    <div class="mout-bo-section-container">
        <div class="mout-bo-top-search-bar">
            <form action="{{route('storeSearch')}}" method="get">
                <div class="floating-label">
                    <input type="text" class="floating-input" placeholder=" " name="search-shop" id="search-shop">
                    <label for="search-shop" class="float">Magasins</label>
                    <span class="highlight"></span>
                </div>

                <div class="select floating-label">
                    <select name="search-type" id="type-shop" class="select-hidden custom-select">
                        <option value="">Type de magasin</option>
                        @foreach($storeTypes as $storeType)
                            <option @if(request()->query->get('search-type') == $storeType->id) selected @endif value="{{$storeType->id}}">{{$storeType->type}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="" name="page" id="pageInProgress">
                <button type="submit" class="btn mout-btn-add">
                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span>
                    Chercher
                </button>
            </form>
        </div>
    </div>

    <div class="mout-bo-section">
        <div class="mout-bo-shop-container">
            <div class="row">
                @foreach($stores as $store)
                    @include('layouts.storecards.storecards')

                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {!! $stores->appends(request()->query())->links() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
