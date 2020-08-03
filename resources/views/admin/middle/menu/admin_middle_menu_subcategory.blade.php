@foreach($subCategories as $subcategory)
    <div class="submenu-category-content">
        <img src="{{asset('/storage/category/' . \Illuminate\Support\Str::slug($subcategory['libelle']) . '/' . $subcategory['img_path'])}}" alt="{{$subcategory['libelle']}}">
        <p class="submenu-category mout--regular">{{$subcategory['libelle']}}</p>
    </div>
@endforeach
