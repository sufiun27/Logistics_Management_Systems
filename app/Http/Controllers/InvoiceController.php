<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\DataTables\InvoicesDataTable;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(InvoicesDataTable $dataTable)
    {
        
        return $dataTable->render('invoice.invoice');
        // $invoices = Invoice::paginate(10);
        // return view('invoice.invoice', compact('dataTable'));
    }
}
