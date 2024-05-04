<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SalesReportDataTable;

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


}
