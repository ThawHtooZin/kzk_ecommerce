<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $q = Order::query()->with('user')->latest();

        if ($request->filled('status')) {
            $st = (string) $request->input('status');
            if (in_array($st, Order::STATUSES, true)) {
                $q->where('status', $st);
            }
        }

        $orders = $q->paginate(20)->withQueryString();

        return view('admin.orders.index', [
            'title' => 'Orders',
            'subtitle' => 'Manage customer orders',
            'orders' => $orders,
            'statusFilter' => $request->input('status'),
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', [
            'title' => 'Order #'.$order->id,
            'subtitle' => $order->user?->email ?? '',
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:'.implode(',', Order::STATUSES)],
            'admin_note' => ['nullable', 'string', 'max:5000'],
        ]);

        $order->update([
            'status' => $validated['status'],
            'admin_note' => $validated['admin_note'] ?: null,
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('status', 'Order updated.');
    }
}
