<nav class="foodcard-navigation">
    @foreach($categories as $category)
        @foreach($category->categoryLocales as $locale)
            <a href="{{ route('apiClientChooseCategory', [$store->slug, $category->id]) }}" class="foodcard-navigation-content @if($category->id === intval(request('categoryId'))) active @elseif( intval(request('categoryId')) === $category->id) @endif">
                {!! $locale->icon !!}
                <p class="mout--regular">{{ $locale->libelle }}</p>
            </a>
        @endforeach
    @endforeach

    <a href="" class="foodcard-navigation-content">
        <i class="fal fa-hat-chef"></i>
        <p class="mout--regular">formules</p>
    </a>

    <a href="" class="foodcard-navigation-content">
        <i class="fal fa-comment-exclamation"></i>
        <p class="mout--regular">allergènes</p>
    </a>
</nav>
