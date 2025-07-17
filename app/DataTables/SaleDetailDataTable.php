<?php

namespace App\DataTables;

use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SaleDetailDataTable extends DataTable
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
                <a class="btn-outline-info btn-sm" href="' . route('sales.details', $query->id) . '"><b>'.$query->invoice_no.'</b></a>
            ';
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SaleDetail $model)
    {
        $query = SaleDetail::query();
        return $query->orderByDesc('created_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('saledetail-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),

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
                Column::make('buyer_contract'),
                Column::make('order_no'),
                Column::make('style_no'),
                Column::make('product_type'),
                Column::make('shipped_qty'),
                Column::make('carton_qty'),
                Column::make('shipped_fob_value'),
                Column::make('shipped_cm_value'),
                Column::make('cbm_value'),
                Column::make('gross_wet'),
                Column::make('net_wet'),
                Column::make('eta_date'),
                Column::make('vessel_name'),
                Column::make('shipbording_date'),
                Column::make('bl_no'),
                Column::make('bl_date'),
                Column::make('final_qty'),
                Column::make('final_fob'),
                Column::make('final_cm'),
                Column::make('remarks'),
                Column::make('created_by'),
                Column::make('updated_by'),
                Column::make('created_at'),
                Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SaleDetail_' . date('YmdHis');
    }
}
