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
<h1>購購物車</h1>

@if(empty($cart))
    <p>購物車是空的。</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>商品名稱</th>
            <th>單價</th>
            <th>數量</th>
            <th>小計</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart as $productId => $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>${{ number_format($item['price'], 0) }}</td>
            <td>
                <form action="{{ route('cart.update', $productId) }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                    <button type="submit" class="btn btn-success btn-sm">更新</button>
                </form>
            </td>
            <td>${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
            <td>
                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('確定要移除這項商品嗎？')">移除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
    @csrf
    <button type="submit" class="btn btn-warning">清空購物車</button>
</form>

<a href="{{ route('checkout.index') }}" class="btn btn-primary mt-3">前往結帳</a>
@endif

</x-layouts.app>
