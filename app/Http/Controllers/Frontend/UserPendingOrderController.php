<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserPendingOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserPendingOrderController extends Controller
{
    /**
     * Display all pending orders only using the specific DataTable.
     *
     * @param UserPendingOrderDataTable $dataTable
     * @return \Illuminate\View\View
     */
    public function index(UserPendingOrderDataTable $dataTable)
    {
        // This will use the UserPendingOrderDataTable to only show pending orders
        return $dataTable->render('frontend.dashboard.pendingorder.index');
    }

    /**
     * Show the details of a specific order.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.pendingorder.show', compact('order'));
    }

    /**
     * Cancel an order.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(string $id)
    {
        $order = Order::findOrFail($id);

        // Cancel the order if its status is 'pending'
        if ($order->order_status === 'pending') {
            $order->order_status = 'canceled';
            $order->save();
            return redirect()->route('user.pending.orders.index')->with('success', 'Order has been canceled successfully.');
        }

        return redirect()->route('user.pending.orders.index')->with('error', 'Order cannot be canceled.');
    }

    /**
     * Return a delivered order.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function return(string $id)
    {
        $order = Order::findOrFail($id);

        // Allow return only if the status is 'delivered'
        if ($order->order_status === 'delivered') {
            $order->order_status = 'returned';
            $order->save();
            return redirect()->route('user.pending.orders.index')->with('success', 'Order has been returned successfully.');
        }

        return redirect()->route('user.pending.orders.index')->with('error', 'Order cannot be returned.');
    }
}
