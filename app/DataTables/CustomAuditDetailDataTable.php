<?php

namespace App\DataTables;

use App\Models\CustomAuditDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomAuditDetailDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            return '
                <a class="btn-outline-info btn-sm" href="' . route('audit.editAudit', $query->id) . '"><b>'.$query->invoice_no.'</b></a>
            ';
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CustomAuditDetail $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('customauditdetail-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),

            Column::make('invoice_no'),
            Column::make('import_reg_no'),
            Column::make('import_bond'),
            Column::make('total_fabric_used'),
            Column::make('adjusted_reg'),
            Column::make('adjusted_reg_page'),
            Column::make('created_at'),
        
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CustomAuditDetail_' . date('YmdHis');
    }
}
