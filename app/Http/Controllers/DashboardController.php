<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportFormApparel;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $query = ExportFormApparel::with([
        'saleDetail',
        'shipping',
        'billingDetail',
        'logisticsDetail'
    ])->where('invoice_site', auth()->user()->site);

    // ✅ Search by invoice number
    if ($request->filled('invoice')) {
        $query->where('invoice_no', 'like', '%' . $request->invoice . '%');
    }

    // ✅ Filter by date range (created_at)
    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $query->orderBy('created_at', 'desc');

    $data = $query->paginate(10);

    $data->getCollection()->transform(function ($item) {
        return [
            'invoice'         => $item->invoice_no ?? null,
            'exportFormApparel' => $item->invoice_no ?? null,
            'saleDetail'      => $item->saleDetail->invoice_no ?? null,
            'shipping'        => $item->shipping->invoice_no ?? null,
            'billingDetail'   => $item->billingDetail->invoice_no ?? null,
            'logisticsDetail' => $item->logisticsDetail->invoice_no ?? null,
            'created_at'      => $item->created_at->format('Y-m-d')
        ];
    });

    return view('dashboard.index', compact('data', 'request'));
}


}

// $validated = $request->validate([
    //     'site'       => 'required|string',
    //     'invoice_no' => 'nullable|string',
    //     'start_date' => 'nullable|date',
    //     'end_date'   => 'nullable|date|after_or_equal:start_date',
    // ]);


// if (!empty($validated['invoice_no'])) {
    //     $query->where('invoice_no', $validated['invoice_no']);
    // }

    // // ✅ Filter by shipping->exp_date
    // if (!empty($validated['start_date'])) {
    //     $query->whereHas('shipping', function ($q) use ($validated) {
    //         $q->whereDate('ex_factory_date', '>=', $validated['start_date']);
    //     });
    // }

    // if (!empty($validated['end_date'])) {
    //     $query->whereHas('shipping', function ($q) use ($validated) {
    //         $q->whereDate('ex_factory_date', '<=', $validated['end_date']);
    //     });
    // }
