<x-layouts.app>
    <style>
    /* 調整價格欄位與庫存欄位的內距 */
    td:nth-child(2), /* 價格欄 */
    td:nth-child(3)  /* 庫存欄 */
    {
        padding-left: 20px;
        padding-right: 20px;
        /* 也可以調整字體大小或對齊方式 */
    }
    </style>
    <h1>商品列表</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">新增商品</a>
    <!--@if($products->isEmpty())
        <p>目前沒有商品</p>
    @else -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>名稱</th>
                <th>價格</th>
                <th>庫存</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                <td>${{ number_format($product->price, 0) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @auth
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline-flex align-items-center">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control form-control-sm me-2" style="width: 70px;">
                            <button type="submit" class="btn btn-primary btn-sm">加入購物車</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">請先登入</a>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</x-layouts.app>
