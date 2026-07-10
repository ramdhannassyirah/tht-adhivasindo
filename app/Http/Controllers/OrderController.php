<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $orders = Order::with('details.product', 'user')->latest()->get();
        } else {
            $orders = Order::with('details.product')->where('user_id', $user->id)->latest()->get();
        }

        return response()->json([
            'status' => true,
            'data' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            $productIds = collect($request->items)->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();

            foreach ($request->items as $item) {
                $product = $products->find($item['product_id']);

                if ($product->stock < $item['qty']) {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => "Stok {$product->name} tidak cukup",
                        ],
                        400,
                    );
                }

                $total += $product->price * $item['qty'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => 'cash',
            ]);

            foreach ($request->items as $item) {
                $product = $products->find($item['product_id']);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['qty'],
                ]);

                $product->decrement('stock', $item['qty']);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Checkout berhasil',
                'data' => $order,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'status' => false,
                    'message' => 'Checkout gagal',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('details.product', 'user');

        return response()->json([
            'status' => true,
            'data' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
