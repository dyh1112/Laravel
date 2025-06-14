@php
    // 取得 session 中購物車數量，預設為0
    $cart = session('cart', []);
    $totalQuantity = collect($cart)->sum('quantity');
@endphp

<li class="nav-item">
    <a href="{{ route('cart.index') }}" class="nav-link position-relative">
        🛒
        @if($totalQuantity > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $totalQuantity }}
                <span class="visually-hidden">購物車商品數量</span>
            </span>
        @endif
    </a>
</li>
