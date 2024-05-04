<?php

namespace App\DataTables;

use App\Models\SalesReport;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'salesreport.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable. SalesReport
     */
    public function query()
        {
           
            if ($this->start_date!= NULL && $this->end_date != NULL ) {
                return SalesReport::whereBetween('ex_factory_date', [$this->start_date, $this->end_date]);
            }else{
                return SalesReport::query();
            }
                
            
        }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('salesreport-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                       // Button::make('pdf'),
                        Button::make('print'),
                        //Button::make('reset'),
                        //Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('site')->label('Site'),
            Column::make('invoice_no')->label('Invoice Number'),
            Column::make('invoice_date')->label('Invoice Date'),
            Column::make('consignee_name')->label('Consignee Name'),
            Column::make('contract_date')->label('Contract Date'),
            Column::make('order_no')->label('Order Number'),
            Column::make('style_no')->label('Style Number'),
            Column::make('item_name')->label('Item Name'),
            Column::make('product_type')->label('Product Type'),
            Column::make('ex_factory_date')->label('Ex Factory Date'),
            Column::make('cargorpt_date')->label('Cargorpt Date'),
            Column::make('shipbording_date')->label('Shipbording Date'),
            Column::make('bl_no')->label('BL Number'),
            Column::make('bl_date')->label('BL Date'),
            Column::make('eta_date')->label('ETA Date'),
            Column::make('quantity')->label('Quantity'),
            Column::make('incoterm')->label('Incoterm'),
            Column::make('amount')->label('Amount'),
            Column::make('freight_value')->label('Freight Value'),
            Column::make('fob')->label('FOB'),
            Column::make('cm_amount')->label('CM Amount'),
            Column::make('shipped_qty')->label('Shipped Quantity'),
            Column::make('shipped_fob_value')->label('Shipped FOB Value'),
            Column::make('shipped_cm_value')->label('Shipped CM Value'),
            Column::make('transport_port')->label('Transport Port'),
            Column::make('carton_qty')->label('Carton Quantity'),
            Column::make('cbm_value')->label('CBM Value'),
            Column::make('exp_no')->label('Exp Number'),
            Column::make('exp_date')->label('Exp Date'),
            Column::make('vessel_name')->label('Vessel Name'),
            Column::make('ep_date')->label('EP Date'),
            Column::make('cnf_agent')->label('CNF Agent'),
            Column::make('dst_country_name')->label('Destination Country Name'),
            Column::make('dst_country_port')->label('Destination Country Port'),
            Column::make('sb_no')->label('SB Number'),
            Column::make('sb_date')->label('SB Date'),
            Column::make('final_qty')->label('Final Quantity'),
            Column::make('final_fob')->label('Final FOB'),
            Column::make('final_cm')->label('Final CM'),
            Column::make('remarks')->label('Remarks'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SalesReport_' . date('YmdHis');
    }
}
