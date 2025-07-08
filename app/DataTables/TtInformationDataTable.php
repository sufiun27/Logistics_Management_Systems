<?php

namespace App\DataTables;

use App\Models\TtInformation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TtInformationDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return '<a class="btn btn-sm btn-outline-info" href="' . route('ttInformation.ttDetails', $row->id) . '"><b>' . e($row->tt_no) . '</b></a>';
            })
            ->addColumn('create_date', function ($row) {
                return optional($row->created_at)->format('d-m-Y');
            })
            ->editColumn('tt_date', function ($row) {
                // Use editColumn for model attributes
                return optional($row->tt_date)->format('d-m-Y');
            })
            ->editColumn('tt_status', function ($row) {
                return $row->tt_status ? 'Active' : 'Inactive';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $query = TtInformation::query();

        if (!empty($this->start_date) && !empty($this->end_date)) {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }

        return $query;
    }

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
                Button::make('reload'),
            ]);
    }

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
            Column::make('tt_date')->title('TT Date'), // Use make, not computed
            Column::computed('create_date')->title('Created Date'),
        ];
    }

    protected function filename(): string
    {
        return 'TtInformation_' . date('YmdHis');
    }
}
