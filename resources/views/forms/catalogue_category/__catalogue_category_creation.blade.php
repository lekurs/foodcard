<form action="{{route('categoryMenuUpdate')}}" method="post">
    @csrf
    @include('flashes.errors')

    <div class="row">
        <div class="col-12">
            <div id="navigation">
                <div class="dd">
                    <ol class="dd-list">
                        @foreach($categoryLocales as $categoryLocale)
                            <li class="dd-item" data-libelle="{{$categoryLocale->libelle}}" data-id="{{$categoryLocale->catalogue_category_id}}">
                                <div class="dd-handle">{{$categoryLocale->libelle}}</div>
                            </li>
                        @endforeach
                    </ol>
                    <form action="" id="form-navigation">
                        <textarea name="navigation" id="nestable-output"></textarea>
                    </form>
                    <button type="submit" class="btn btn-dark mout-add-menus-button">Enregistrer</button>
                </div>
            </div>
            <p>Pas de navigation</p>
        </div>
        <button type="button" class="btn mout-btn-add" data-toggle="modal" data-target="#addCategory">
            Ajouter une catégorie
        </button>
    </div>
</form>
