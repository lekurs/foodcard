<form action="{{route('categoryMenuUpdate')}}" method="post">
    @csrf
    @include('flashes.errors')

    <div class="row">
        <div class="col-12">
            <div id="navigation">
                @if(isset($menu) && !empty($menu))
                <div class="dd">
                    <ol class="dd-list">
                        {!! $menu !!}
                    </ol>
                    <form action="" id="form-navigation">
                        <textarea name="navigation" id="nestable-output"></textarea>
                    </form>
                    <button type="submit" class="btn btn-dark mout-add-menus-button">Enregistrer</button>
                </div>
                @else
                    <p>Pas de navigation</p>
                @endif
            </div>
        </div>
        <button type="button" class="btn mout-btn-add" data-toggle="modal" data-target="#addCategory">
            Ajouter une catégorie
        </button>
    </div>
</form>
