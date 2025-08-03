@extends('template.index')

@section('content')

{{-- ✅ Include Bootstrap Icons if not already --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }
    .table thead th {
        background-color: #f8f9fa;
    }
    .progress-wrapper {
        min-width: 150px;
    }
    .status-icon {
        font-size: 1.25rem;
    }
</style>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title fw-bold">Invoice Status Dashboard 📊</h3>
    </div>
    {{-- ✅ Search Form --}}
<form method="GET" action="{{ route('dashboard.index') }}" class="mb-3">
    <div class="row g-2">
        <div class="col-md-3">
            <input type="text" name="invoice" value="{{ request('invoice') }}" class="form-control" placeholder="Search by Invoice No">
        </div>
        <div class="col-md-3">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-success w-50">Search</button>
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary w-50">Reset</a>
        </div>
    </div>
</form>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Invoice No.</th>
                        <th>Export ✈️</th>
                        <th>Sale 💰</th>
                        <th>Shipping 🚚</th>
                        <th>Billing 🧾</th>
                        <th>Logistics 📦</th>
                        <th>Overall Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        @php
                            $completed = 0;
                            $totalSteps = 5;
                            if(!empty($item['exportFormApparel'])) $completed++;
                            if(!empty($item['saleDetail'])) $completed++;
                            if(!empty($item['shipping'])) $completed++;
                            if(!empty($item['billingDetail'])) $completed++;
                            if(!empty($item['logisticsDetail'])) $completed++;

                            $percentage = ($totalSteps > 0) ? ($completed / $totalSteps) * 100 : 0;

                            $progressClass = 'bg-danger';
                            if ($percentage >= 40) $progressClass = 'bg-warning';
                            if ($percentage >= 70) $progressClass = 'bg-info';
                            if ($percentage == 100) $progressClass = 'bg-success';
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $item['invoice'] }}</td>

                            {{-- ✅ Status Icons --}}
                            @foreach (['exportFormApparel','saleDetail','shipping','billingDetail','logisticsDetail'] as $field)
                                <td>
                                    @if(!empty($item[$field]))
                                        <i class="bi bi-check-circle-fill text-success status-icon" title="Completed"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-danger status-icon" title="Pending"></i>
                                    @endif
                                </td>
                            @endforeach

                            {{-- ✅ Progress Bar --}}
                            <td>
                                <div class="progress-wrapper">
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}"
                                             style="width: {{ $percentage }}%;">
                                             <span class="fw-bold">{{ round($percentage) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <h5>No Invoices Found!</h5>
                                <p>There is no data to display at the moment.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
