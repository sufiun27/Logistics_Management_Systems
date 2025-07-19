<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportFormApparel;
use Illuminate\Support\Facades\DB;
use App\DataTables\SalesReportDataTable;
use App\DataTables\ExportFormApparelDataTable;

class ReportController extends Controller
{
    public function sales(SalesReportDataTable $dataTable, Request $request){

        if (isset($request->start_date)&&isset($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
             $start_date = \Carbon\Carbon::parse($start_date)->startOfDay()->format('Y-m-d');
             $end_date = \Carbon\Carbon::parse($end_date)->endOfDay()->format('Y-m-d');

          return $dataTable->with('start_date', $start_date)
          ->with('end_date', $end_date)
          ->render('reports.sales');
        }else{
            return $dataTable->render('reports.sales');
        }
    }

    public function masterReport(){
        return view('reports.master');
    }

    public function report(Request $request)
    {
        $validated = $request->validate([
            'invoice_no' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $query = ExportFormApparel::with('saleDetail', 'shipping', 'billingDetail', 'logisticsDetail');

        if (isset($request->invoice_no) && $request->invoice_no !== '') {
            $query->where('invoice_no', $request->invoice_no);
        }

        if (isset($request->start_date) && $request->start_date !== '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if (isset($request->end_date) && $request->end_date !== '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $data = $query->get();

        return view('reports.master', compact('data'));
    }


}
