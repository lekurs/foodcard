<form action="{{route('productStore')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('flashes.errors')

    <div class="input-group floating-label">
        <input type="hidden" name="product_id" value="@isset($product) {{ $product->id }}@endisset" id="product">
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
                <textarea name="locale[{{$locale->id}}][description]" id="product_description_{{$locale->id}}" class="floating-textarea w-100" placeholder="Description" rows="10"">@if(isset($product)){{$product->locales()->whereLocaleId($locale->id)->first()->description}}@endif</textarea>
            </div>
        @endforeach
    </div>

    <div class="floating-label">
            <input type="file" name="image[]" multiple id="image">
        <label for="image[]">Ajouter vos photos</label>
    </div>


    <div class="floating-label">
        @foreach($categories as $category)
{{--            {{ dump($category) }}--}}
            <input type="checkbox" value="{{ $category->catalogueCategoryByOrder->id }}" name="category[]" id="category_{{ $category->catalogueCategoryByOrder->id }}">
            <label for="category_{{ $category->catalogueCategoryByOrder->id }}">{{ $category->libelle }}</label>
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

                @foreach($allergies as $allergy)
                    <button type="button" class="btn text-dark allergy-admin @if(isset($allergyByProduct) && in_array($allergy->slug, $allergyByProduct)) btn-allergy-active @else btn-allergy-inactive @endif  btn-allergy" data-allergy="{{ $allergy->slug }}">{!! $allergy->icon !!}<br> {{ $allergy->label }}</button>
                @endforeach
                    <textarea name="allergy" class="textarea-allergy" id="textarea-allergy">@if(isset($allergyByProduct)) {{implode('|', $allergyByProduct)}} @endif</textarea>
        </div>
    </div>

    <div class="floating-label">
        <input type="checkbox" value="1" name="homemade" id="homemade" @if(isset($product) && $product->homemade = 1) checked @endif>
        <label for="homemade">Fait maison</label>
    </div>

    <button type="submit" class="btn mout-btn-add">
        <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Ajouter
    </button>
</form>
