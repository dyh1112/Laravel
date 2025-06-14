<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    public function create()
    {
        return view('products.create');
    }

    // 處理新增商品表單
    public function store(Request $request)
    {
        // 驗證輸入
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        // 新增商品
        Product::create($validated);

        return redirect()->route('products.index')->with('success', '商品新增成功');
    }
}
