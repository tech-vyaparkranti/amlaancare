<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserCompleteOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserCompleteOrderController extends Controller
{
    /**
     * Display all completed orders only using the specific DataTable.
     *
     * @param UserCompleteOrderDataTable $dataTable
     * @return \Illuminate\View\View
     */
    public function index(UserCompleteOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.completeorder.index');
    }

    /**
     * Show the details of a specific completed order.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $order = Order::where('order_status', 'delivered')->findOrFail($id);
        return view('frontend.dashboard.completeorder.show', compact('order'));
    }

    /**
     * Return a delivered order.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function return(string $id)
    {
        $order = Order::where('order_status', 'delivered')->findOrFail($id);

        // Change the status to 'returned'
        $order->order_status = 'returned';
        $order->save();

        return redirect()->route('user.complete.orders.index')->with('success', 'Order has been returned successfully.');
    }
}
