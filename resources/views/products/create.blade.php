<x-layouts.app>
    <h1>新增商品</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">商品名稱</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">價格</label>
            <input type="number" id="price" name="price" step="1" min="0" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">庫存</label>
            <input type="number" id="stock" name="stock" min="0" class="form-control" value="{{ old('stock') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">描述</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">新增商品</button>
    </form>
</x-layouts.app>
