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



                  Column::make('id')->title('ID'),
                  Column::make('item_name')->title('Item Name'),
                  Column::make('hs_code')->title('HS Code'),
                  Column::make('hs_code_second')->title('HS Code 2'),
                  Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('invoice_no'),
                  Column::make('invoice_date')->title('Invoice Date'),
                  Column::make('contract_no')->title('Contract No'),
                  Column::make('contract_date')->title('Contract Date'),
                  Column::make('consignee_name')->title('Consignee Name'),
                  Column::make('consignee_site')->title('Consignee Site'),
                  Column::make('consignee_address')->title('Consignee Address'),
                  Column::make('dst_country_code')->title('Destination Country Code'),
                  Column::make('dst_country_name')->title('Destination Country Name'),
                  Column::make('dst_country_port')->title('Destination Country Port'),
                  Column::make('transport_name')->title('Transport Name'),
                  Column::make('transport_address')->title('Transport Address'),
                  Column::make('transport_port')->title('Transport Port'),
                  Column::make('notify_name')->title('Notify Name'),
                  Column::make('notify_address')->title('Notify Address'),
                  Column::make('section')->title('Section'),
                  Column::make('tt_no')->title('TT No'),
                  Column::make('invoice_site')->title('Invoice Site'),
                  Column::make('tt_date')->title('TT Date'),
                  Column::make('unit')->title('Unit'),
                  Column::make('quantity')->title('Quantity'),
                  Column::make('currency')->title('Currency'),
                  Column::make('amount')->title('Amount'),
                  Column::make('cm_percentage')->title('CM %'),
                  Column::make('incoterm')->title('Incoterm'),
                  Column::make('cm_amount')->title('CM Amount'),
                  Column::make('freight_value')->title('Freight Value'),
                  Column::make('exp_no')->title('EXP No'),
                  Column::make('exp_date')->title('EXP Date'),
                  Column::make('exp_permit_no')->title('EXP Permit No'),
                  Column::make('bl_no')->title('BL No'),
                  Column::make('bl_date')->title('BL Date'),
                  Column::make('ex_factory_date')->title('Ex Factory Date'),
                  Column::make('create_by')->title('Created By'),
                  Column::make('update_by')->title('Updated By'),
                  Column::make('created_at')->title('Created At'),
                  Column::make('updated_at')->title('Updated At'),

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
