@extends('layouts.admin-layout')
@section('title', 'Type de magasins')

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
                    @foreach($types as $type)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td class="type-label">{{$type->type}}</td>
                        <td>
                            <div class="dropdown-actions text-right">
                                <a href="#" class="dropdown-actions-icons" role="button" id="dropdown-action-{{$type->libelle}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-ellipsis-v-alt"></i>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdown-action-{{$type->libelle}}">
                                    <a class="dropdown-item store-type-edit" href="#" data-label="{{$type->type}}" data-id="{{$type->id}}"><i class="far fa-pen"></i> Modifier</a>
                                    <a class="dropdown-item store-type-trash" data-id="{{$type->id}}" href="{{route('storeTypeTrash', $type->id)}}"><i class="fal fa-trash"></i> Supprimer</a>
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
                <a href="#" class="btn mout-btn-add">
                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span> Ajouter un type de commerce</a>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addStoreType" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un type de commerce</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('forms.shops.type.__type_shop_creation')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#store-type').DataTable();

            $('#addStoreType').modal({
                show: false,
            });

            $('.mout-btn-add').on('click', function () {
                $('#addStoreType').modal('show');
            });

            $('.store-type-edit').on('click', function () {
                let id = $(this).data('id');
                let label = $(this).closest('tr').find('td.type-label').text();
                $('#modal-type-id').val(id);
                $('#store_type').val(label);
                $('#addStoreType').modal('show');
            });
        });
    </script>
@endsection
