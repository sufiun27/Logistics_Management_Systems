@extends('template.index')

@section('content')

@php
    $pageTitle = 'Export Form Records';
    $actionUrl = 'exportFormApparel.exportFormApparelDetails';
    $addNewUrl = 'exportFormApparel.addExportFormApparel';
    $tableHeaders = [
    'invoice_no'        => ['title' => 'Invoice No',                'type' => 'string'],
    'invoice_date'      => ['title' => 'Invoice Date',              'type' => 'date'],
    'exp_no'            => ['title' => 'EXP No',                    'type' => 'string'],
    'consignee_name'    => ['title' => 'Consignee Name',             'type' => 'string'],
    'dst_country_port'  => ['title' => 'Destination Country Port',   'type' => 'string'],
    'item_name'         => ['title' => 'Item Name',                  'type' => 'string'],
    'hs_code'           => ['title' => 'HS Code',                    'type' => 'string'],
    'quantity'          => ['title' => 'Quantity',                   'type' => 'string'],
    'incoterm'          => ['title' => 'Incoterm',                   'type' => 'string'],
    'amount'            => ['title' => 'Amount',                     'type' => 'string'],
    'fob_value'         => ['title' => 'FOB Value',                  'type' => 'string'],
    'cm_percentage'     => ['title' => 'CM %',                        'type' => 'string'],
    'cm_amount'         => ['title' => 'CM Amount',                   'type' => 'string'],
    'freight_value'     => ['title' => 'Freight Value',               'type' => 'string'],
    'contract_no'       => ['title' => 'Contract No',                 'type' => 'string'],
    'contract_date'     => ['title' => 'Contract Date',               'type' => 'date'],
];



@endphp

<style>
    /* Reduce table row height and padding */
    .table th, .table td {
        padding: 2px 4px !important; /* smaller vertical & horizontal padding */
        font-size: 12px; /* smaller text to fit more rows */
    }
    .table {
        margin-bottom: 0; /* remove bottom space */
    }
    .table-responsive {
        margin-bottom: 0;
    }
    /* Optional: make table more compact */
    .table-sm > :not(caption) > * > * {
        padding: 2px 4px !important;
    }
</style>

<div class="">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{$pageTitle}}</h5>
            <div>
                <a href="{{ route($addNewUrl) }}" class="btn btn-light btn-sm">➕ Add New</a>
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
        <th class="text-white">Action</th>
        @foreach ($tableHeaders as $info)
            <th class="text-nowrap text-white">{{ $info['title'] }}</th>
        @endforeach
    </tr>
</thead>
<tbody>
    @forelse ($data as $item)
        <tr>
            {{-- Action column --}}
            <td class="text-nowrap">
                @php
                    $createdBy = $item->createdByUser->name ?? 'Unknown';
                    $createdByMail = $item->createdByUser->email ?? 'Unknown';
                    $createdAt = $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '';

                    $updatedBy = $item->updatedByUser->name ?? 'Unknown';
                    $updatedByMail = $item->updatedByUser->email ?? 'Unknown';
                    $updatedAt = $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : '';

                    $tooltip = "Created By: {$createdBy} ({$createdByMail}) | {$createdAt}\n" .
                               "Updated By: {$updatedBy} ({$updatedByMail}) | {$updatedAt}";
                @endphp

                <a href="{{ route($actionUrl, $item->id) }}"
                   class="btn btn-sm btn-primary rounded-5"
                   title="{{ $tooltip }}">
                    📄
                </a>
            </td>

            {{-- Data columns --}}
            @foreach ($tableHeaders as $key => $info)
                <td class="text-nowrap">
                    @if ($info['type'] === 'date')
                        {{ $item->$key ? \Carbon\Carbon::parse($item->$key)->format('d M, Y') : 'N/A' }}
                    @else
                        {{ $item->$key ?? 'N/A' }}
                    @endif
                </td>
            @endforeach
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

