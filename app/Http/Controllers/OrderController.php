<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'payment_method' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang masih kosong.');
        }

        DB::transaction(function () use ($request, $cart) {

            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'total_price' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'Menunggu pembayaran',
            ]);

            foreach ($cart as $productId => $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect('/')->with(
            'success',
            'Pesanan berhasil dibuat.'
        );
    }
}