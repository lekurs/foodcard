<table class="table mout-table products-table">
    <thead>
    <tr>
        <th>{{ $category->libelle }}</th>
        <th>type</th>
        <th>libellé</th>
        <th>action</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($category->products as $product)
    <tr>
        <td>
            @if(!is_null($category->img_path))
                <img src="{{ asset('storage/category/' . $category->slug . '/' . $category->img_path) }}" alt="{{ $category->libelle }}"
                     class="img-fluid product-table-img-mini">
            @else
                <i class="fal fa-image fa-2x"></i>
            @endif
        </td>
        <td>{{ $category->libelle }}</td>
        <td>{{ $product->langueFR->libelle }}</td>
        <td><a href="#" class="btn mout-btn-login" data-product="{{ $product->id }}">Renseigner ce plat</a></td>
        <td><i class="fal fa-eye fa-2x"></i></td>
    </tr>
    @endforeach
    </tbody>
</table>
