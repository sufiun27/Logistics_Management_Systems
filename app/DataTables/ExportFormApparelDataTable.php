<?php

namespace App\DataTables;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExportFormApparelDataTable extends DataTable
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
                <a class="btn-outline-info btn-sm" href="' . route('exportFormApparel.exportFormApparelDetails', $query->id) . '"><b>'.$query->invoice_no.'</b></a>
            ';
        })
       
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query()
    {
        $query = ExportFormApparel::query();

        if($this->site != NULL){
        $query->where('site', $this->site);
        }
        if ($this->start_date != NULL && $this->end_date != NULL) {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }
       
            
        

        return $query;
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('exportformapparel-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
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
            
            Column::make('item_name'),
            Column::make('contract_no'),
            Column::make('contract_date'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('invoice_no'),
            Column::make('invoice_date'),
            Column::make('site'),
            Column::make('consignee_name'),
            Column::make('hs_code'),
            Column::make('dst_country_name'),
            Column::make('dst_country_port'),
            Column::make('quantity'),
            Column::make('incoterm'),
            Column::make('amount'),
            Column::make('cm_amount'),
            Column::make('freight_value'),
            Column::make('created_at'),
            

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ExportFormApparel_' . date('YmdHis');
    }
}
