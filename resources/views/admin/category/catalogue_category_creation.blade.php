@extends('layouts.admin-layout')
@section('title', 'Catégorie de produits')

@section('body')
    <div class="mout-bo-section-container">
        @include('forms.catalogue_category.__catalogue_category_creation')
    </div>

@endsection

@section('js')
    <script src="{{asset('js/admin/category-admin.js')}}"></script>
@endsection
