<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 取得購物車資料（存在 session）
    protected function getCart()
    {
        return session()->get('cart', []);
    }

    // 儲存購物車資料
    protected function saveCart($cart)
    {
        session(['cart' => $cart]);
    }

    // 購物車列表
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    // 新增商品到購物車
    public function add(Product $product, Request $request)
    {
        $cart = $this->getCart();

        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) $quantity = 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', '商品已加入購物車');
    }

    // 更新購物車商品數量
    public function update(Product $product, Request $request)
    {
        $cart = $this->getCart();
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity < 1) {
            return redirect()->route('cart.index')->with('error', '數量不可小於1');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            $this->saveCart($cart);
            return redirect()->route('cart.index')->with('success', '購物車已更新');
        }

        return redirect()->route('cart.index')->with('error', '商品不在購物車中');
    }

    // 移除購物車商品
    public function remove(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $this->saveCart($cart);
        }
        return redirect()->route('cart.index')->with('success', '商品已移除');
    }

    // 清空購物車
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', '購物車已清空');
    }
}
