<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Storage;

class CategoryDataTable extends DataTable
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
            $editBtn = "<a href='".route('admin.category.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('admin.category.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

            return $editBtn.$deleteBtn;
        })
        // category_banner - Resolve URL for category banner stored in 'uploads/categories'
        ->addColumn('category_banner', function($query) {
            return $query->category_banner 
                ? '<img src="' . asset('storage/' . $query->category_banner) . '" alt="" height="100" width="100" class="img-fluid"/>' 
                : '<span>No Image</span>';
        })
        
        // image - Resolve URL for image stored in 'uploads/categories'
        ->addColumn('image', function($query) {
            return $query->image 
                ? '<img src="' . asset('storage/' . $query->image) . '" style="width:50px; height:50px;" />' 
                : '<span>No Image</span>';
        })
        ->addColumn('status', function($query){
            $button = '<label class="custom-switch mt-2">
                <input type="checkbox" '.($query->status ? 'checked' : '').' name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
            </label>';
            return $button;
        })
        ->rawColumns(['category_banner', 'action', 'status', 'image'])
        ->setRowId('id');
}



    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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
            Column::make('id')->width(100),
            // Column::make('icon')->width(300),
            Column::make('category_banner')->title('Category Image')->width(150),
            Column::make('image')->title('Image')->width(150), // Added Image column
            Column::make('name')->width(200),
            Column::make('min_quantity'),
            Column::make('status')->width(100),
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
        return 'Category_' . date('YmdHis');
    }
}
