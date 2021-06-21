<nav class="text-white bg-indigo-900 py-3 mb-3">
    <div class="container mx-auto flex items-center justify-between">
        <ul class="flex space-x-3">
            @foreach($categories as $category)
                <li>
                    <a
                        href="{{ route('categories.show',$category) }}"
                        title="{{ $category->name }}"
                        class="hover:underline"
                    >{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('cart.show') }}" class="bg-indigo-700 px-2 py-2">Shopping cart</a>

    </div>
</nav>
