@extends('template.index')

@section('content')

@php
use App\Models\User;
$user = auth()->user();

function formatDate($date) {
    try {
        return $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : '-';
    } catch (\Exception $e) {
        return '-';
    }
}
isset($data) ? $data : $data = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
@endphp

<div class="container-fluid py-4">
    <h2 class="mb-4">{{ ucfirst($module) }} Report</h2>

    <form action="{{ route('reports.individual.report') }}" method="GET" class="row g-3 mb-4">
        @csrf
        <div class="col-md-3">
            <label for="module" class="form-label">Report Module</label>
            <select name="module" id="module" class="form-control" required>
                <option value="">Select Module</option>
                <option value="export" {{ old('module', request('module', $module)) == 'export' ? 'selected' : '' }}>Export</option>
                <option value="sales" {{ old('module', request('module', $module)) == 'sales' ? 'selected' : '' }}>Sales</option>
                <option value="shipping" {{ old('module', request('module', $module)) == 'shipping' ? 'selected' : '' }}>Shipping</option>
                <option value="billing" {{ old('module', request('module', $module)) == 'billing' ? 'selected' : '' }}>Billing</option>
                <option value="logistics" {{ old('module', request('module', $module)) == 'logistics' ? 'selected' : '' }}>Logistics</option>
            </select>
            @error('module')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="site" class="form-label">Factory</label>
            <input type="text" value="{{ $user->site }}" readonly name="site" class="form-control">
            @error('site')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="invoice_no" class="form-label">Invoice No</label>
            <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                   placeholder="Enter Invoice No" value="{{ old('invoice_no', request('invoice_no')) }}">
            @error('invoice_no')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Exp: Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                   value="{{ old('start_date', request('start_date')) }}">
            @error('start_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label">Exp: End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                   value="{{ old('end_date', request('end_date')) }}">
            @error('end_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Generate Report</button>
            @if(request('module') || $module !== 'export')
                <a href="{{ route('reports.individual.export', array_merge(['module' => request('module', $module)], request()->only(['site', 'invoice_no', 'start_date', 'end_date']))) }}"
                   class="btn btn-primary">
                    Download {{ ucfirst(request('module', $module)) }} Report
                </a>
            @endif
        </div>
    </form>

    @if ($data->isEmpty() && request('module'))
    <div class="alert alert-info">No data available for the selected filters.</div>
@elseif (!request('module') && $module == 'export' && $data->isEmpty())
    <div class="alert alert-info">Please select a module and filters to generate a report.</div>
@else
    <div class="table-container">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="table-dark">
                <tr>
                    @foreach($headers[$module] as $field)
                        <th>{{ $field['title'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        @foreach($headers[$module] as $field)
                            @php
                                $value = $row[$field['column']] ?? '-';
                                if (str_contains($field['column'], 'date')) {
                                    $value = formatDate($value);
                                }
                            @endphp
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination links -->
    <div class="mt-3">
        {{ $data->appends(request()->except('page'))->links() }}
    </div>
@endif
</div>

<style>
.table-container {
    overflow-x: auto;
    max-width: 100%;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    background-color: #fff;
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.95rem;
}

.table th, .table td {
    vertical-align: middle;
    white-space: nowrap;
    padding: 0.25rem 1rem;
    border: 1px solid #dee2e6;
}

.table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background-color: #0056b3;
    color: #ffffff;
    text-align: center;
    font-weight: 600;
    border-bottom: 2px solid #00408a;
}

.table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.table tbody tr:hover {
    background-color: #adcef1;
    transition: background-color 0.2s ease-in-out;
}

.table tbody td {
    color: #343a40;
}

.table tbody td:first-child {
    font-weight: 500;
}
</style>

@endsection