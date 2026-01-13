@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('ttInformation.ttInformation') }}" class="btn btn-dark btn-sm">Back</a>
            <a href="{{ route('ttInformation.editTtInformation', $tt->id) }}" class="btn btn-info btn-sm">Edit</a>
            {{-- Conditional buttons for clarity --}}
            @if($tt->tt_status == 1)
                <a href="{{ route('ttInformation.deactive',$tt->id) }}" class="btn btn-warning btn-sm">Deactive</a>
            @else
                <a href="{{ route('ttInformation.active',$tt->id) }}" class="btn btn-success btn-sm">Active</a>
            @endif
            <a href="{{ route('ttInformation.deleteTtInformation',$tt->id) }}" class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure you want to delete this TT Information?')">Delete</a>
        </div>
    </div>

    <div class="card-body">
        <h4 class="card-title">TT Details Information</h4>
        <x-message/>
        <hr>
        <br>
        <div class="row mb-4">
            <div class="col-4"><h4>TT No: {{ $tt->tt_no }}</h4></div>
            <div class="col-4"><h4>Currency : {{ $tt->tt_currency }}</h4></div>
            <div class="col-4"><h4>Amount : {{ $tt->tt_amount }}</h4></div>
            <div class="col-4"><h4>Used : {{ $tt->tt_used_amount }}</h4></div>
            <div class="col-4"><h4>Available Balance: {{ $tt->balance }}</h4></div>
            <div class="col-4"><h4>Bank : {{ $tt->bank_name }}</h4></div>
            <div class="col-4"><h4>Site : {{ $tt->tt_site }}</h4></div>
            <div class="col-4"><h4>Date : {{ $tt->tt_date }}</h4></div>
            <div class="col-4"><h4>Created By : {{ $tt->tt_created_by }}</h4></div>
            <div class="col-4"><h4>Created At : {{ $tt->created_at }}</h4></div>
            <div class="col-4"><h4>Modified By : {{ $tt->Modified_by }}</h4></div>
            <div class="col-4"><h4>Updated At : {{ $tt->updated_at }}</h4></div>
            <div class="col-4"><h4>Status : {{ $tt->tt_status == 1 ? 'Active' : 'Deactive' }}</h4></div>
            <div class="col-4"><h4>Remarks : {{ $tt->tt_remarks }}</h4></div>
        </div>
        <hr>

        {{-- TT Utilization Table Section --}}
        <h5 class="card-title mt-4 mb-3">TT Utilization Details (Export Forms)</h5>

        @php
            use App\Models\ExportFormApparel;
            $exportForms = ExportFormApparel::where('tt_no', $tt->tt_no)->get();
        @endphp

        {{-- Search Input (M-0 P-0) --}}
        <div class="row mb-3 m-0 p-0">
            <div class="col-md-4 m-0 p-0">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search by Invoice or Contract No..." onkeyup="filterTable()">
            </div>
        </div>

        {{-- Table Container (P-0 M-0) --}}
        <div class="table-responsive m-0 p-0">
            <table class="table table-bordered table-sm table-hover m-0 p-0" id="exportFormsTable">
                <thead class="bg-light">
                    <tr>
                        <th class="p-2">#</th>
                        <th class="p-2">Invoice No</th>
                        <th class="p-2">Invoice Date</th>
                        <th class="p-2">Contract No</th>
                        <th class="p-2">Contract Date</th>
                        <th class="p-2">TT Date</th>
                        <th class="p-2">Quantity</th>
                        <th class="p-2">FOB Value</th>
                        <th class="p-2">CM %</th>
                        <th class="p-2">CM Amount</th>
                        <th class="p-2">Amount Utilized</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($exportForms as $form)
                    <tr>
                        <td class="p-2">{{ $loop->iteration }}</td>
                        <td class="p-2">{{ $form->invoice_no }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($form->invoice_date)->format('Y-m-d') }}</td>
                        <td class="p-2">{{ $form->contract_no }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($form->contract_date)->format('Y-m-d') }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($form->tt_date)->format('Y-m-d') }}</td>
                        <td class="p-2">{{ number_format($form->quantity) }}</td>
                        <td class="p-2">{{ number_format($form->fob_value, 2) }}</td>
                        <td class="p-2">{{ number_format($form->cm_percentage, 2) }}%</td>
                        <td class="p-2">{{ number_format($form->cm_amount, 2) }}</td>
                        <td class="p-2">{{ number_format($form->amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center p-2">No export forms found utilizing this TT.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Client-side JavaScript for search functionality
    function filterTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("exportFormsTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            // Check Invoice No (column index 1) AND Contract No (column index 3)
            var invoice_td = tr[i].getElementsByTagName("td")[1];
            var contract_td = tr[i].getElementsByTagName("td")[3];

            if (invoice_td || contract_td) {
                var showRow = false;

                if (invoice_td) {
                    txtValue = invoice_td.textContent || invoice_td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        showRow = true;
                    }
                }

                if (!showRow && contract_td) {
                    txtValue = contract_td.textContent || contract_td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        showRow = true;
                    }
                }

                if (showRow) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

@endsection
