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

    public function report(Request $request)
    {
        // Validate date inputs
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Build the query with date filtering
        $query = DB::table('export_form_apparels as e')
            ->leftJoin('sale_details as s', 'e.invoice_no', '=', 's.invoice_no')
            ->leftJoin('shippings as sh', 'e.invoice_no', '=', 'sh.invoice_no')
            ->leftJoin('billing_details as b', 'e.invoice_no', '=', 'b.invoice_no')
            ->leftJoin('logistics_details as l', 'e.invoice_no', '=', 'l.invoice_no')
            ->select(
                'e.*',
                's.*',
                'sh.*',
                'b.*',
                'l.*'
            );

        // Apply date filters if provided
        if ($request->filled('start_date')) {
            $query->whereDate('e.created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('e.created_at', '<=', $request->end_date);
        }

        // Fetch data
        $data = $query->get();

        // Group data by table
        $groupedData = [
            'export_form_apparels' => [],
            'sale_details' => [],
            'shippings' => [],
            'billing_details' => [],
            'logistics_details' => []
        ];

        foreach ($data as $row) {
            $rowArray = (array) $row;

            // Assuming columns are prefixed or unique per table, split them accordingly
            $groupedData['export_form_apparels'][] = array_filter($rowArray, function ($key) {
                return strpos($key, 'e.') === 0 || !in_array(explode('.', $key)[0], ['s', 'sh', 'b', 'l']);
            }, ARRAY_FILTER_USE_KEY);

            $groupedData['sale_details'][] = array_filter($rowArray, function ($key) {
                return strpos($key, 's.') === 0;
            }, ARRAY_FILTER_USE_KEY);

            $groupedData['shippings'][] = array_filter($rowArray, function ($key) {
                return strpos($key, 'sh.') === 0;
            }, ARRAY_FILTER_USE_KEY);

            $groupedData['billing_details'][] = array_filter($rowArray, function ($key) {
                return strpos($key, 'b.') === 0;
            }, ARRAY_FILTER_USE_KEY);

            $groupedData['logistics_details'][] = array_filter($rowArray, function ($key) {
                return strpos($key, 'l.') === 0;
            }, ARRAY_FILTER_USE_KEY);
        }

        // Remove empty arrays to clean up response
        foreach ($groupedData as $key => $value) {
            $groupedData[$key] = array_filter($value, function ($item) {
                return !empty($item);
            });
        }

        // Handle export to Excel if requested
        if ($request->has('export') && $request->export === 'excel') {
            return Excel::download(new CustomExport($groupedData), 'report.xlsx');
        }

        // Return JSON response
        return response()->json(['index' => $groupedData]);
    }



}
