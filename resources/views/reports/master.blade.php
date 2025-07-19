@extends('template.index')

@section('content')

<form action="{{ route('reports.report') }}" method="GET" class="row g-3">
    <div class="col-md-4">
        <label for="invoice_no" class="form-label">Invoice No</label>
        <input type="text" name="invoice_no" id="invoice_no" class="form-control"
               placeholder="Enter Invoice No" value="{{ request('invoice_no') }}">
    </div>

    <div class="col-md-4">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control"
               value="{{ request('start_date') }}">
    </div>

    <div class="col-md-4">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control"
               value="{{ request('end_date') }}">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </div>
</form>

@if(isset($data) && count($data))
    <div class="mt-4">
        <h3>Report Results ({{ $data->count() }})</h3>
        <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
    </div>
@elseif(isset($data))
    <div class="mt-4 alert alert-warning">
        No records found for the given criteria.
    </div>
@endif

@endsection
