<?php

namespace App\DataTables;

use App\Models\TtInformation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class TtInformationDataTable extends DataTable
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
                    <a class="btn-outline-info btn-sm" href="' . route('ttInformation.ttDetails', $query->id) . '"><b>'.$query->tt_no.'</b></a>
                ';
            })
            
            ->addColumn('create_date', function ($query) {
                return $query->created_at->format('d-m-Y');
            })
            ->addColumn('tt_status', function ($query) {
                return $query->tt_status == 1 ? 'Active' : 'Inactive';
            })
            ->setRowId('id');
    }
    

    /**
     * Get the query source of dataTable.
     */
    // public function query(TtInformation $model): QueryBuilder
    // {
    //     // Retrieve the additional variable passed from the controller
    //    //$ttNo = $this->variables['additionalVariable'] ?? null;
    //     // $ttNo = request('search');
    //     // isset($ttNo) ? $ttNo : $ttNo = 'pai ni';
    //     //dd($ttNo);
    //     $query = $model->newQuery();
    //     // if ($ttNo) {
    //     //     $query->where('tt_no', $ttNo);
    //     // }
    //     return $query;
    // }

    public function query()
        {
           
            if ($this->start_date!= NULL && $this->end_date != NULL ) {
                return TtInformation::whereBetween('created_at', [$this->start_date, $this->end_date]);
            }else{
                return TtInformation::query();
            }
                
            
        }



    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('ttinformation-table')
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
            Column::computed('action')
                  ->title('TT No')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('tt_amount')->title('Amount'),
            Column::make('tt_currency')->title('Currency'),
            Column::make('tt_used_amount')->title('Used Amount'),
            Column::make('bank_name')->title('Bank'),
            Column::make('tt_site')->title('Site'),
            Column::make('tt_status')->title('Status'),
            Column::make('tt_remarks')->title('Remarks'),
            Column::make('create_date')->title('Create at'),
            
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TtInformation_' . date('YmdHis');
    }
}
