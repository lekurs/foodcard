<form action="{{route('productStore')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('flashes.errors')
    <div class="input-group floating-label">
        <input type="hidden" name="product_id" value="@if(isset($product)){{$product->id}}@endif" id="product">
            <div class="input-group-prepend choose-langage">
                <div class="mout-dropdown">
                    <input class="mout-dropdown-toggle" type="text">
                    <div id="chTxt" class="mout-dropdown-text"><img src="{{asset('images/flags/'. $locales->first()->label . '.png')}}" class="img-fluid choice-lg" data-id="{{$locales->first()->id}}"></div>
                    <ul class="mout-dropdown-content">
                        @foreach($locales as $locale)
                            <li>
                                <a class="" href="#">
                                    <img src="{{asset('images/flags/'. $locale->label . '.png')}}" class="img-fluid choice-lg" data-id="{{$locale->id}}">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @foreach($locales as $locale)
            <input type="text" name="locale[{{$locale->id}}][libelle]" id="product_{{$locale->id}}" class="form-control floating-input product_{{$locale->id}} product_label" placeholder="Produit" value="@if(isset($product)){{$product->locales()->whereLocaleId($locale->id)->first()->libelle}}@endif">
        @endforeach
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
            <input type="file" name="image[]" multiple id="image">
        <label for="image[]">Ajouter vos photos</label>
    </div>


    <div class="floating-label">
        @foreach($categories as $category)
            <input type="checkbox" value="{{$category->id}}" name="category[]" id="category_{{$category->id}}">
            <label for="category_{{$category->libelle}}">{{$category->libelle}}</label>
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
        <h5 class="allergy mout--regular">allergènes</h5>
        <div class="button-allergy-container">
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('egg', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="egg"><i class="far fa-egg-fried"></i><br> Oeufs</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('fish', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="fish"><i class="fal fa-fish"></i><br> Poisson</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('crustace', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="crustace"><i class="fal fa-fish"></i><br> Crustacé</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('mollusque', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="mollusque"><i class="fal fa-fish"></i><br> Mollusque</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('gluten', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="gluten"><i class="fal fa-wheat"></i><br> Gluten</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('arachides', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="arachides"><i class="fal fa-wheat"></i><br> Arachides</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('nutts', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="nutts"><i class="fal fa-acorn"></i><br> Fruits à coque</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('soja', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="soja"><i class="fal fa-acorn"></i><br> Soja</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('sesame', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="sesame"><i class="fal fa-acorn"></i><br> Sésame</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('celery', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="celery"><i class="fal fa-fish"></i><br> Céleri</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('lupin', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="lupin"><i class="fas fa-wheat"></i><br> Lupin</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('milk', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="milk"><i class="fal fa-jug"></i> <br>Produits laitiers</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('mustard', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="mustard"><i class="fal fa-fish"></i><br> Moutarde</button>
            <button type="button" class="btn text-dark @if(isset($allergy) && in_array('sulfite', $allergy)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="sulfite"><i class="fal fa-fish"></i><br> Sulfite</button>
        </div>
        <textarea name="allergy" class="textarea-allergy" id="textarea-allergy">@if(isset($allergy)) {{implode('|', $allergy)}} @endif</textarea>
    </div>

    <div class="floating-label">
        <input type="checkbox" value="1" name="homemade" id="homemade" @if(isset($product) && $product->homemade = 1) checked @endif>
        <label for="homemade">Fait maison</label>
    </div>

    <button type="submit" class="btn mout-btn-add">
        <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Ajouter
    </button>
</form>
