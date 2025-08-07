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
use App\Models\User;

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

        ->addColumn('created_at', function ($row) {
            return optional($row->created_at)->format('d-m-Y');
        })
        ->addColumn('updated_at', function ($row) {
            return optional($row->created_at)->format('d-m-Y');
        })

        ->setRowId('id')
        
        ->editColumn('invoice_no', function ($row) {
            $createdBy = $row->createdByUser->name ?? 'Unknown';
            $createdByMail = $row->createdByUser->email ?? 'Unknown';
            $createdAt = $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '';
        
            $updatedBy = $row->updatedByUser->name ?? 'Unknown';
            $updatedByMail = $row->updatedByUser->email ?? 'Unknown';
            $updatedAt = $row->updated_at ? $row->updated_at->format('Y-m-d H:i:s') : '';
        
            $tooltip = "Created By: {$createdBy} ({$createdByMail}) | {$createdAt}\n".
                       "Updated By: {$updatedBy} ({$updatedByMail}) | {$updatedAt}";
        
            return '<span title="'.$tooltip.'">'.$row->invoice_no.'</span>';
        })
        ->rawColumns(['invoice_no', 'action'])

        
        ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query()
    {
        $query = ExportFormApparel::with(['createdByUser', 'updatedByUser']); // eager load users;

        $user = auth()->user();
        $query->where('invoice_site', $user->site);
        
        if ($this->start_date != NULL && $this->end_date != NULL) {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }

        return $query->orderByDesc('created_at');
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

            Column::computed('action')
            ->title('Select')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),

                Column::make('invoice_no')->title('Invoice No'),
                Column::make('invoice_date')->title('Invoice Date'),
                Column::make('exp_no')->title('EXP No'),
                Column::make('consignee_name')->title('Consignee Name'),
                Column::make('dst_country_port')->title('Destination Country Port'),
                Column::make('item_name')->title('Item Name'),
                Column::make('hs_code')->title('HS Code'),
                Column::make('quantity')->title('Quantity'),
                Column::make('incoterm')->title('Incoterm'),
                Column::make('cm_percentage')->title('CM %'),
                Column::make('cm_amount')->title('CM Amount'),
                  Column::make('freight_value')->title('Freight Value'),
                  Column::make('contract_no')->title('Contract No'),
                  Column::make('contract_date')->title('Contract Date'),

                // Invoice No	
                // Invoice Date	
                // Exporter	
                // Consignee Name	
                // Destination	Port	
                // Item Name	
                // H.S. Code	
                // Qty	Incoterm	
                // FOB	C.M.	
                // Contract No	
                // Contract Date


                //   Column::make('id')->title('ID'),
                //   
                  
                //   Column::make('hs_code_second')->title('HS Code 2'),

                  
                  
                  
                //   Column::make('consignee_site')->title('Consignee Site'),
                //   Column::make('consignee_address')->title('Consignee Address'),
                //   Column::make('dst_country_code')->title('Destination Country Code'),
                //   Column::make('dst_country_name')->title('Destination Country Name'),
                  
                //   Column::make('transport_name')->title('Transport Name'),
                //   Column::make('transport_address')->title('Transport Address'),
                //   Column::make('transport_port')->title('Transport Port'),
                //   Column::make('notify_name')->title('Notify Name'),
                //   Column::make('notify_address')->title('Notify Address'),
                //   Column::make('section')->title('Section'),
                //   Column::make('tt_no')->title('TT No'),
                //   Column::make('invoice_site')->title('Invoice Site'),
                //   Column::make('tt_date')->title('TT Date'),
                //   Column::make('unit')->title('Unit'),
                // Column::make('amount')->title('Amount'),
                //   Column::make('currency')->title('Currency'),
                  
                  
                  
                  
                //   Column::make('exp_date')->title('EXP Date'),
                //   Column::make('exp_permit_no')->title('EXP Permit No'),
                //   Column::make('bl_no')->title('BL No'),
                //   Column::make('bl_date')->title('BL Date'),
                //   Column::make('ex_factory_date')->title('Ex Factory Date'),
                //   Column::make('net_wet')->title('Net Wet'),
                //   Column::make('gross_wet')->title('Gross Wet'),
                //   Column::make('create_by')->title('Created By'),
                //   Column::make('update_by')->title('Updated By'),
                //   Column::make('created_at')->title('Created At'),
                //   Column::make('updated_at')->title('Updated At'),

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
