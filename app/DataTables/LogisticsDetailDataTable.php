<?php

namespace App\DataTables;

use App\Models\LogisticsDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LogisticsDetailDataTable extends DataTable
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
                <a class="btn-outline-info btn-sm" href="' . route('logistics.editLogistics', $query->id) . '"><b>'.$query->invoice_no.'</b></a>
            ';
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LogisticsDetail $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('logisticsdetail-table')
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
                  
            
            Column::make('receivable_amount'),
            Column::make('doc_process_fee'),
            Column::make('short_shipment_certificate_fee'),
            Column::make('seal_lock_charge'),
            Column::make('agency_commission'),
            Column::make('documentation_charge'),
            Column::make('transportation_charge'),
            Column::make('factory_loading_fee'),
            Column::make('total_charges'),
            Column::make('cargo_ho_date'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LogisticsDetail_' . date('YmdHis');
    }
}
