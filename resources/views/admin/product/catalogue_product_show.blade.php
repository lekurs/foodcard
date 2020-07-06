@extends('layouts.admin-layout')
@section('title', 'Produits')

@section('body')
    <div class="mout-bo-section-container">
        <div class="row no-gutters">
            <div class="col-12">
                <table id="product-type" class="table mout-bo-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$product->libelle}}</td>
                            <td>
                                <div class="dropdown-actions text-right">
                                    <a href="#" class="dropdown-actions-icons" role="button" id="dropdown-action-{{$type->libelle}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fal fa-ellipsis-v-alt"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdown-action-{{$type->libelle}}">
                                        <a class="dropdown-item" href="#"><i class="far fa-pen"></i> Modifier</a>
                                        <a class="dropdown-item" href="#"><i class="fal fa-trash"></i> Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-12">
                <a href="#" class="btn mout-btn-add mout-btn-add-product">
                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span> Ajouter un produit</a>
            </div>
        </div>
    </div>

    <div class="slider-add-form">
        <span class="times-container">
            <i class="fas fa-times"></i>
        </span>

        @include('forms.products.__product_creation')
    </div>
@endsection

@section('js')
    <script src="{{asset('js/admin/products-admin.js')}}"></script>
    <script src="{{asset('js/admin/product-creation-admin.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#product-type').DataTable();

            tinymce.init({
                selector: 'textarea',
                // plugins: 'a11ychecker advcode linkchecker autolink media mediaembed powerpaste tinymcespellchecker',
                // toolbar: 'a11ycheck code',
                toolbar_mode: 'floating',
            });
        });
    </script>
@endsection
