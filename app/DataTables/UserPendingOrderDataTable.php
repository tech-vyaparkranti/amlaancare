<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserPendingOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                // Show button for order details
                $showBtn = "<a href='".route('user.orders.show', $query->id)."' class='btn btn-primary'><i class='far fa-eye'></i></a>";

                // Cancel button (only if order is pending)
                $cancelBtn = '';
                if ($query->order_status === 'pending') {
                    $cancelBtn = "<a href='".route('user.orders.cancel', $query->id)."' class='btn btn-danger'><i class='fas fa-ban'></i> Cancel</a>";
                }

                // Return button (only if order is delivered)
                $returnBtn = '';
                if ($query->order_status === 'delivered') {
                    $returnBtn = "<a href='".route('user.orders.return', $query->id)."' class='btn btn-warning'><i class='fas fa-undo'></i> Return</a>";
                }

                // Return the concatenated buttons
                return $showBtn . ' ' . $cancelBtn . ' ' . $returnBtn;
            })
            ->addColumn('customer', function($query){
                return $query->user->name;
            })
            ->addColumn('amount', function($query){
                return $query->currency_icon.$query->amount;
            })
            ->addColumn('date', function($query){
                return date('d-M-Y', strtotime($query->created_at));
            })
            ->addColumn('payment_status', function($query){
                if($query->payment_status === 1){
                    return "<span class='badge bg-success'>complete</span>";
                }else {
                    return "<span class='badge bg-warning'>pending</span>";
                }
            })
            ->addColumn('order_status', function($query){
                switch ($query->order_status) {
                    case 'pending':
                        return "<span class='badge bg-warning'>pending</span>";
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge bg-info'>processed</span>";
                    case 'dropped_off':
                        return "<span class='badge bg-info'>dropped off</span>";
                    case 'shipped':
                        return "<span class='badge bg-info'>shipped</span>";
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary'>out for delivery</span>";
                    case 'delivered':
                        return "<span class='badge bg-success'>delivered</span>";
                    case 'canceled':
                        return "<span class='badge bg-danger'>canceled</span>";
                    default:
                        return "<span class='badge bg-secondary'>unknown</span>";
                }
            })
            ->rawColumns(['order_status', 'action', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        // Fetch orders for the authenticated user and filter by 'pending' order status
        return $model::where('user_id', Auth::user()->id)
                     ->where('order_status', 'pending') // Only show orders with status 'pending'
                     ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendororder-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invocie_id'), // Correct the column name to match your data
            Column::make('customer'),
            Column::make('date'),
            Column::make('product_qty'),
            Column::make('amount'),
            Column::make('order_status'),
            Column::make('payment_status'),
            Column::make('payment_method'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorOrder_' . date('YmdHis');
    }
}
