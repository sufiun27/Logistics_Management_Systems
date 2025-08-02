<?php

namespace App\DataTables;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingDataTable extends DataTable
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
                <a class="btn-outline-info btn-sm" href="' . route('shipping.updateShipping', $query->id) . '"><b>'.$query->invoice_no.'</b></a>
            ';
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Shipping $model): QueryBuilder
    {
        $user = auth()->user();

        return Shipping::query()
            ->whereHas('exportFormApparel', function ($q) use ($user) {
                $q->where('invoice_site', $user->site);
            })
            ->orderByDesc('created_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('shipping-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
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
            Column::make('factory'),
            Column::make('ep_no'),
            Column::make('ep_date'),
            Column::make('exp_no'),
            Column::make('exp_date'),

            Column::make('exp_no'),
            Column::make('ex_factory_date'),
            Column::make('cnf_agent'),
            Column::make('transport_port'),
            Column::make('sb_no'),
            Column::make('sb_date'),
            Column::make('vessel_no'),
            Column::make('cargorpt_date'),
            Column::make('bring_back'),
            Column::make('shipped_out'),
            Column::make('shipped_cancel'),
            Column::make('shipped_back'),
            Column::make('unshipped'),

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
        return 'Shipping_' . date('YmdHis');
    }
}
