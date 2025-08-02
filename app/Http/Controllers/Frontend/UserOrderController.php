<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.order.index');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }

    public function cancel(string $id)
    {
        $order = Order::findOrFail($id);

        // Cancel the order if its status is 'pending'
        if ($order->order_status === 'pending') {
            $order->order_status = 'canceled';
            $order->save();
            return redirect()->route('user.orders.index')->with('success', 'Order has been canceled successfully.');
        }

        return redirect()->route('user.orders.index')->with('error', 'Order cannot be canceled.');
    }

    public function return(string $id)
    {
        $order = Order::findOrFail($id);

        // Allow return only if the status is 'delivered'
        if ($order->order_status === 'delivered') {
            $order->order_status = 'returned';
            $order->save();
            return redirect()->route('user.orders.index')->with('success', 'Order has been returned successfully.');
        }

        return redirect()->route('user.orders.index')->with('error', 'Order cannot be returned.');
    }
}
