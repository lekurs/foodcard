@extends('layouts.admin-layout')

@section('title', 'Utilisateurs')

@section('body')
    <div class="mout-bo-section-container">
        <div class="row no-gutters">
            <div class="col-12 col-md-12 col-lg-3">
                <a href="#" class="btn mout-btn-add">
                    <span class="btn-label"><i class="fas fa-chevron-right"></i></span>
                    Ajouter un rôle
                </a>

                <div class="roles-menu">
                    <ul>
                        @foreach($roles as $role)
                            <li>
                                <a href="#">
                                    {{$role->role}}

                                    <span class="roles-options">
                                        <i class="fal fa-edit" data-role="{{$role->id}}" data-toggle="modal" data-target="#{{$role->role}}"></i>
                                        <i class="far fa-trash role-trash" data-role="{{$role->id}}"></i>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-9">

            </div>
        </div>
    </div>


    <!-- Modal -->
    @foreach($roles as $role)
    <div class="modal fade" id="{{$role->role}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('userRoleUpdate', $role->id)}}" method="post" name="role-form">
                        @csrf
                        @include('flashes.errors')
                        <div class="floating-label">
                            <input id="role" type="text" class="floating-input form-control @error('role') is-invalid @enderror" name="role" value="{{$role->role}}" placeholder=" " required autocomplete="role">
                            <label for="name" class="float form-control-label required">Fonction utilisateur</label>
                        </div>
                        <div class="floating-label">
                            <button type="submit" class="btn mout-btn-add">
                                <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Enregistrer</button>
                        </div>
                    </form>
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    @endforeach

@endsection

@section('js')
    <script src="{{asset('js/admin/roles.js')}}"></script>
@endsection
