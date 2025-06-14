<x-layouts.app>
    <h1>{{ $product->name }}</h1>
    <p><strong>價格：</strong> ${{ number_format($product->price, 2) }}</p>
    <p><strong>描述：</strong> {{ $product->description }}</p>
    <p><strong>庫存：</strong> {{ $product->stock }}</p>

    @auth
    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-3">
        @csrf  
        <label>數量：
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
        </label>
        <button type="submit" class="btn btn-primary btn-sm">加入購物車</button>
    </form>
    @else
    <p><a href="{{ route('login') }}">請先登入加入購物車</a></p>
    @endauth

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">返回商品列表</a>
</x-layouts.app>
