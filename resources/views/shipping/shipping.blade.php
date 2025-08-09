@extends('template.index')

@section('content')

@php
    // Define table headers: column => [title, type]
    // 'type' can be 'date' for Carbon formatting or 'string' for normal text
    $tableHeaders = [
        'invoice_no'       => ['title' => 'Invoice No',          'type' => 'string'],
        'factory'          => ['title' => 'Factory',             'type' => 'string'],
        'ep_no'            => ['title' => 'EP No',               'type' => 'string'],
        'ep_date'          => ['title' => 'EP Date',             'type' => 'date'],
        'exp_no'           => ['title' => 'Export No',           'type' => 'string'],
        'exp_date'         => ['title' => 'Export Date',         'type' => 'date'],
        'ex_factory_date'  => ['title' => 'Ex Factory Date',     'type' => 'date'],
        'cnf_agent'        => ['title' => 'CNF Agent',           'type' => 'string'],
        'transport_port'   => ['title' => 'Transport Port',      'type' => 'string'],
        'sb_no'            => ['title' => 'SB No',               'type' => 'string'],
        'sb_date'          => ['title' => 'SB Date',             'type' => 'date'],
        'vessel_no'        => ['title' => 'Vessel No',           'type' => 'string'],
        'cargorpt_date'    => ['title' => 'Cargo Report Date',   'type' => 'date'],
        'created_at'       => ['title' => 'Created At',          'type' => 'date'],
    ];
@endphp

<div class="container-fluid p-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Shipping Records</h5>
            <div>
                <a href="#" class="btn btn-light btn-sm">➕ Add New</a>
            </div>
        </div>

        <div class="card-body">
            {{-- Filter Form --}}
            <form action="{{ url()->current() }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">🔍</span>
                        <input
                            type="text"
                            name="invoice_no"
                            class="form-control"
                            placeholder="Search by Invoice No..."
                            value="{{ request('invoice_no') }}"
                        >
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="factory" class="form-select">
                        <option value="">All Factories</option>
                        @foreach($factories ?? [] as $factory)
                            <option value="{{ $factory }}" {{ request('factory') == $factory ? 'selected' : '' }}>
                                {{ $factory }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    @if(request()->hasAny(['invoice_no', 'factory']))
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Clear Filters</a>
                    @endif
                </div>
            </form>

            {{-- Data Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                             <th class="text-center text-primary">Actions</th>
                            @foreach ($tableHeaders as $key => $info)
                                <th class="text-nowrap text-white">{{ $info['title'] }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                @foreach ($tableHeaders as $key => $info)
                                    <td class="text-nowrap">
                                        @if ($info['type'] === 'date')
                                            {{ $item->$key ? \Carbon\Carbon::parse($item->$key)->format('d M, Y') : 'N/A' }}
                                        @else
                                            {{ $item->$key ?? 'N/A' }}
                                        @endif
                                    </td>
                                @endforeach
                                <td class="text-center">
                                    {{-- Action buttons here (edit/delete/view etc) --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($tableHeaders) + 1 }}" class="text-center text-muted">
                                    No shipping records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($data->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                    </div>
                    <div>
                        {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
