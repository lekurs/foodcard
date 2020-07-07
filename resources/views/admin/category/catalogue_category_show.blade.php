@extends('layouts.admin-layout')
@section('title', 'Catégorie de produits')

@section('body')
    <div class="mout-bo-section-container">
        <div class="row no-gutters">
            <div class="col-12">
                <table id="store-type" class="table mout-bo-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->libelle}}</td>
                            <td>
                                <div class="dropdown-actions text-right">
                                    <a href="#" class="dropdown-actions-icons" role="button" id="dropdown-action-{{$type->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fal fa-ellipsis-v-alt"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdown-action-{{$type->id}}">
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
                <a href="{{route('storesTypesShowCreation')}}" class="btn mout-btn-add">
                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span> Ajouter un type de commerce</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#store-type').DataTable();
        } );
    </script>
@endsection
