<table class="table mout-table products-table">
    <thead>
    <tr>
        <th>#</th>
        <th class="text-center">Catégorie</th>
        <th class="text-center">libellé</th>
        <th class="text-center">action</th>
        <th class="text-center"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($productList as $product)
    <tr>
        <td>
            @if(isset($product->catalogueProductMedias[0]) && !is_null($product->catalogueProductMedias[0]->path))
                <img src="{{ asset('storage/products/' . '/' . $product->catalogueProductMedias[0]->path) }}" alt="{{ $category->libelle }}"
                     class="img-fluid product-table-img-mini">
            @else
                <i class="fal fa-image fa-2x"></i>
            @endif
        </td>
        <td class="text-center">{{ $category->categoryLocalesFR->first()->libelle }}</td>
        <td class="text-center">{{ $product->langueFR->libelle }}</td>
        <td class="text-center">@if($product->visibility === "all")<a href="#" class="btn mout-btn-login" data-product="{{ $product->id }}">Personnaliser ce plat</a>@endif</td>
        <td class="text-center"><i class="fal fa-eye fa-2x"></i></td>
    </tr>
    @endforeach
    </tbody>
</table>
