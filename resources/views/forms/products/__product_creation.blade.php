<form action="{{route('productStore')}}" method="post">
    @csrf
    @include('flashes.errors')
    <div class="input-group floating-label">
        @foreach($locales as $locale)
            <input type="text" name="locale[{{$locale->id}}][libelle]" id="product_{{$locale->id}}" class="form-control floating-input product_{{$locale->id}} product_label" placeholder="Produit" value="@if(isset($product)){{$product->locales()->whereLocaleId($locale->id)->first()->libelle}}@endif">
        @endforeach
        <input type="hidden" name="product_id" value="@if(isset($product)){{$product->id}}@endif" id="product">
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
            <div class="textarea-container product_label product_{{$locale->id}}">
                <textarea name="locale[{{$locale->id}}][description]" id="product_description_{{$locale->id}}" class="floating-textarea">
                    @if(isset($product)){{$product->locales()->whereLocaleId($locale->id)->first()->description}}@endif
                </textarea>
            </div>
        @endforeach
    </div>

    <div class="floating-label">
      <input type="text" name="float[price]" id="product_price" class="floating-input product_price" placeholder=" " value="@if(isset($product)){{$product->catalogueProductFloats()->first()->price}}@endif">
        <label for="price" class="float">Prix</label>
    </div>

    <div class="floating-label">
        <input type="text" name="float[special_price]" id="product_special_price" class="floating-input product_special_price" placeholder=" " @if(isset($product)){{$product->catalogueProductFloats()->first()->special_price}}@endif>
        <label for="special_price" class="float">Prix spécial</label>
    </div>

    <div class="floating-label">
        <input type="text" name="float[buying_price]" id="product_buying_price" class="floating-input product_price" placeholder=" " @if(isset($product)){{$product->catalogueProductFloats()->first()->buying_price}}@endif>
        <label for="buying_price" class="float">Prix d'achat</label>
    </div>

    <div class="floating-label">
        <button type="button" class="btn @if(isset($allergy) && in_array('egg', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="egg"><i class="far fa-egg-fried"></i><br> Oeufs</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('nutts', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="nutts"><i class="fal fa-acorn"></i><br> Fruits à coque</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('fish', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="fish"><i class="fal fa-fish"></i><br> Poisson</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('gluten', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="gluten"><i class="fal fa-wheat"></i><br> Gluten</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('milk', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="milk"><i class="fal fa-jug"></i> <br>Produits laitiers</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('celery', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="celery"><i class="fal fa-fish"></i><br> Célerie</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('mustard', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="mustard"><i class="fal fa-fish"></i><br> Moutarde</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('lobster', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="lobster"><i class="fal fa-fish"></i><br> Mollusques</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('jumbo', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="jumbo"><i class="fal fa-fish"></i><br> Crevettes</button>
        <button type="button" class="btn @if(isset($allergy) && in_array('lupin', $allergy)) btn-light @else btn-dark @endif  btn-allergy" data-allergy="lupin"><i class="fas fa-wheat"></i><br> Lupin</button>

        <textarea name="allergy" class="textarea-allergy" id="textarea-allergy">@if(isset($allergy)) {{implode('|', $allergy)}} @endif</textarea>
    </div>

    <button type="submit" class="btn mout-btn-add">
        <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Ajouter
    </button>
</form>