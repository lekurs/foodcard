<form action="{{route('catalogueCategoryStore')}}" method="post">
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

    <div class="input-group floating-label">
        <select name="category-parent" id="category-parent">
            <option value=""></option>
            @foreach($categoryLocales as $locale)
            <option value="">{{$locale->libelle}}</option>
            @endforeach
        </select>
    </div>

    <div class="input-group floating-label">

    </div>


    <button type="submit" class="btn mout-btn-add">
        <span class="btn-label"><i class="fas fa-chevron-right"></i></span> Ajouter une catégorie</button>
</form>
