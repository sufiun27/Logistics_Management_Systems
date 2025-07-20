<?php

namespace App\Exports;

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    protected $data;
    protected $table;

    public function __construct($data, $table)
    {
        $this->data = $data;
        $this->table = $table;
    }

    public function view(): View
    {
        return view('reports.export.report', [
            'data' => $this->data,
            'table' => $this->table
        ]);
    }
}

