<form action="{{route('catalogueCategoryStore')}}" method="post">
    @csrf
    @include('flashes.errors')
    <div class="input-group floating-label">
        @foreach($locales as $locale)
            <input type="text" name="product[{{$locale->id}}]" id="product_{{$locale->id}}" class="form-control floating-input product_{{$locale->id}} product_label" placeholder="Produit">
        @endforeach
        <input type="hidden" name="product_id" value="" id="product">
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

    <div class="floating-label">
        @foreach($locales as $locale)
        <textarea name="description" id="product_description_{{$locale->id}}" class="floating-textarea product_{{$locale->id}} product_description_txt product_label"></textarea>
        @endforeach
    </div>

    <div class="floating-label">
        @foreach($locales as $locale)
          <input type="number" name="product_price_{{$locale->id}}" id="product_price_{{$locale->id}}" class="floating-input product_{{$locale->id}} product_price product_label" placeholder=" ">
            <label for="product_price_{{$locale->id}}" class="float">Prix</label>
        @endforeach
    </div>

    <div class="floating-label">
        @foreach($locales as $locale)
            <input type="number" name="product_special_price_{{$locale->id}}" id="product_special_price_{{$locale->id}}" class="floating-input product_{{$locale->id}} product_special_price product_label" placeholder=" ">
            <label for="product_special_price_{{$locale->id}}" class="float">Prix spécial</label>
        @endforeach
    </div>

    <div class="floating-label">
        @foreach($locales as $locale)
            <input type="number" name="product_buying_price_{{$locale->id}}" id="product_buying_price_{{$locale->id}}" class="floating-input product_{{$locale->id}} product_price" placeholder=" ">
            <label for="product_buying_price_{{$locale->id}}" class="float">Prix d'achat</label>
        @endforeach
    </div>
</form>
