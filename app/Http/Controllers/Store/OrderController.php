<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->withCount('items')
            ->latest()
            ->paginate(15);

        return view('store.orders.index', [
            'orders' => $orders,
            'title' => 'My orders',
            'breadcrumbs' => 'Home / My orders',
        ]);
    }

    public function show(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        $order->load('items.product');

        return view('store.orders.show', [
            'order' => $order,
            'title' => 'Order #'.$order->id,
            'breadcrumbs' => 'Home / My orders / #'.$order->id,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'phone' => ['nullable', 'string', 'max:80'],
            'address' => ['nullable', 'string', 'max:5000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.qty' => ['required', 'integer', 'min:1', 'max:999'],
            'items.*.size' => ['nullable', 'string', 'max:80'],
        ]);

        $order = DB::transaction(function () use ($validated, $request) {
            $subtotal = 0;
            $rows = [];

            foreach ($validated['items'] as $line) {
                $product = Product::query()->active()->findOrFail($line['product_id']);
                $qty = (int) $line['qty'];
                $sizeRaw = isset($line['size']) ? trim((string) $line['size']) : '';
                $sizes = $product->sizesForSelect();

                if (count($sizes) > 0) {
                    if ($sizeRaw === '') {
                        throw ValidationException::withMessages([
                            'items' => 'Please select a size for: '.$product->name,
                        ]);
                    }
                    if (! in_array($sizeRaw, $sizes, true)) {
                        throw ValidationException::withMessages([
                            'items' => 'Invalid size for: '.$product->name,
                        ]);
                    }
                    $size = $sizeRaw;
                } else {
                    $size = null;
                }

                $unit = (int) $product->price_mmk;
                $lineTotal = $unit * $qty;
                $subtotal += $lineTotal;

                $rows[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price_mmk' => $unit,
                    'qty' => $qty,
                    'size' => $size,
                ];
            }

            $o = Order::query()->create([
                'user_id' => $request->user()->id,
                'status' => Order::STATUS_PENDING,
                'subtotal_mmk' => $subtotal,
                'phone' => $validated['phone'] ?: null,
                'address' => $validated['address'] ?: null,
            ]);

            foreach ($rows as $r) {
                $o->items()->create($r);
            }

            return $o;
        });

        return response()->json([
            'message' => 'Order placed successfully.',
            'order_id' => $order->id,
            'redirect' => route('orders.show', $order),
        ]);
    }
}
