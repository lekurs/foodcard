@extends('admin-layout')
@section('title', 'Navigation')

@section('body')
<h2 class="admin-title">Modification du menu</h2>

<div id="navigation">
    <div class="dd">
        <ol class="dd-list">
        @foreach($navigations as $navigation)
            <li class="dd-item" data-id="{{$navigation->id}}">
                <div class="dd-handle">{{$navigation->wording}}</div>
            </li>
        @endforeach
        </ol>
        <form action="" id="form-navigation">
            <textarea name="navigation" id="nestable-output"></textarea>

        </form>
        <button type="button" class="btn btn-dark mout-add-menus-button">Enregistrer</button>
    </div>
</div>
        <p>Pas de navigation</p>


<div class="mout-create-navigation-container">
    <button type="button" class="btn mout-save-menus-button"><i class="fas fa-plus"></i> </button>
</div>

<div class="mout-create-navigation-content">
</div>

@endsection
