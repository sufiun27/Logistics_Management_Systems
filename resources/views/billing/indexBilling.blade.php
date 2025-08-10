@extends('template.index')

@section('content')

@php
    $pageTitle = 'Billing Records';
    $actionUrl = 'billing.editBilling';
    $addNewUrl = 'billing.addBilling';
    $tableHeaders = [
    'invoice_no'         => ['title' => 'Invoice No',             'type' => 'string'],
    'sb_no'              => ['title' => 'SB No',                  'type' => 'string'],
    'sb_date'            => ['title' => 'SB Date',                 'type' => 'date'],
    'doc_submit_date'    => ['title' => 'Doc Submit Date',         'type' => 'date'],
    'hk_courier_no'      => ['title' => 'HK Courier No',           'type' => 'string'],
    'hk_courier_date'    => ['title' => 'HK Courier Date',         'type' => 'date'],
    'buyer_courier_no'   => ['title' => 'Buyer Courier No',        'type' => 'string'],
    'buyer_courier_date' => ['title' => 'Buyer Courier Date',      'type' => 'date'],
    'lead_time'          => ['title' => 'Lead Time',               'type' => 'string'],
    'bank_submit_date'   => ['title' => 'Bank Submit Date',        'type' => 'date'],
    'mode'               => ['title' => 'Mode',                    'type' => 'string'],
    'bd_thc'              => ['title' => 'BD THC',                 'type' => 'string'],
    'created_by'         => ['title' => 'Created By',              'type' => 'string'],
    'updated_by'         => ['title' => 'Updated By',              'type' => 'string'],
    'created_at'         => ['title' => 'Created At',              'type' => 'date'],
    'updated_at'         => ['title' => 'Updated At',              'type' => 'date'],
];

@endphp

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
                            @foreach ($tableHeaders as $info)
                                <th class="text-nowrap text-white">{{ $info['title'] }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                @foreach ($tableHeaders as $key => $info)
                                    <td class="text-nowrap">
                                        @if ($key === 'invoice_no')

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
                                                class="btn btn-sm btn-primary rounded-5 text-decoration-none"
                                                title="{{ $tooltip }}">
                                                    {{ $item->invoice_no ?? 'N/A' }}
                                                </a>

                                        @elseif ($info['type'] === 'date')
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







