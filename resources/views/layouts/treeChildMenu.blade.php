<ul class="list-group list-group-flush sub-list-group">
    @foreach ($categories ?? [] as $category)
        <li class="catalog-link"><a href="/catalog/{{ $category->id }}">{{ $category->name }}</a></li>
        @if ($category->SubCategory->count() > 0)
            @include('layouts.treeChildMenu', [
                'categories' => $category->SubCategory ?? [],
            ])
        @endif
    @endforeach
</ul>
