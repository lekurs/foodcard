@extends('layouts.admin-layout')
@section('title', 'Catégorie de produits')

@section('body')
    <div class="mout-bo-section-container">
        <H2>Getion des catégories</H2>
        @include('forms.catalogue_category.__catalogue_category_creation')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('catalogueCategoryStore')}}" method="post">
                <div class="modal-body">
                        @csrf
                        @include('flashes.errors')
                    <div class="input-group floating-label">
                        @foreach($locales as $locale)
                            <input type="text" name="category[{{$locale->id}}]" id="category_{{$locale->id}}" class="form-control floating-input category_{{$locale->id}} category_label" aria-label="Text input with dropdown button" placeholder="Category">
                        @endforeach
                        <input type="hidden" name="category_id" value="" id="category">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Langues</button>
                            <div class="dropdown-menu">
                                @foreach($locales as $locale)
                                    <a class="dropdown-item" href="#">
                                        <img src="{{asset('images/flags/'. $locale->label . '.png')}}" class="img-fluid choice-lg" data-id="{{$locale->id}}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/admin/category-admin.js')}}"></script>
    <script>
        $('.dd').on('change', function () {
            $('#nestable-output').val(JSON.stringify($('.dd').nestable('serialize')));
        });

        $('.dd').nestable({ /* config options */ });

    </script>
@endsection
