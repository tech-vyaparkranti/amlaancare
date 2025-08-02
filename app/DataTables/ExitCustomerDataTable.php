<?php

namespace App\DataTables;

use App\Models\UserExit;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Carbon\Carbon; // Import Carbon for date formatting

class ExitCustomerDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('user_id', function ($row) {
                return $row->user_id ?? 'Guest';
            })
            ->addColumn('url', function ($row) {
                return '<a href="' . $row->url . '" target="_blank">' . $row->url . '</a>';
            })
            ->editColumn('timestamp', function ($row) {
                return Carbon::parse($row->timestamp)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s');
            })
            ->rawColumns(['url']); // Make 'url' column render as HTML
    }

    public function query(UserExit $model)
    {
        return $model->newQuery()->orderByDesc('timestamp');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('userexit-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(2); // Order by timestamp (3rd column, index starts at 0)
    }

    protected function getColumns()
    {
        return [
            'user_id' => ['title' => 'User ID'],
            'url' => ['title' => 'Exit URL'],
            'timestamp' => ['title' => 'Exit Time'],
        ];
    }
}
