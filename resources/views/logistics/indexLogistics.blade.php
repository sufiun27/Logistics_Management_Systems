@extends('template.index')

@section('content')

@php
    $pageTitle = 'Logistics Records';
    $actionUrl = 'logistics.editLogistics';
    $addNewUrl = 'logistics.addLogistics';
    $tableHeaders = [
        'invoice_no'        => ['title' => 'Invoice No',                'type' => 'string'],
    'receivable_amount'                        => ['title' => 'Receivable Amount',                        'type' => 'string'],
    'doc_process_fee'                          => ['title' => 'Doc Process Fee',                          'type' => 'string'],
    'seal_lock_charge'                         => ['title' => 'Seal Lock Charge',                         'type' => 'string'],
    'agency_commission'                        => ['title' => 'Agency Commission',                        'type' => 'string'],
    'documentation_charge'                     => ['title' => 'Documentation Charge',                     'type' => 'string'],
    'transportation_charge'                    => ['title' => 'Transportation Charge',                    'type' => 'string'],
    'short_shipment_certificate_fee'           => ['title' => 'Short Shipment Certificate Fee',           'type' => 'string'],
    'factory_loading_fee'                      => ['title' => 'Factory Loading Fee',                      'type' => 'string'],
    'uploading_fee_forwarder_wh'                => ['title' => 'Uploading Fee Forwarder WH',               'type' => 'string'],
    'truck_demurrage_fee_delay_at_depot'       => ['title' => 'Truck Demurrage Fee Delay at Depot',        'type' => 'string'],
    'cfs_depot_mixed_cargo_loading_fee'        => ['title' => 'CFS Depot Mixed Cargo Loading Fee',         'type' => 'string'],
    'customs_misc_remark_reasons_charge'       => ['title' => 'Customs Misc Remark Reasons Charge',        'type' => 'string'],
    'customs_remark_charge_misc_reasons'       => ['title' => 'Customs Remark Charge Misc Reasons',        'type' => 'string'],
    'cargo_ho_date'                            => ['title' => 'Cargo HO Date',                             'type' => 'date'],
    'deadline_bill_submission'                 => ['title' => 'Deadline Bill Submission',                  'type' => 'date'],
    'bill_received_date'                       => ['title' => 'Bill Received Date',                        'type' => 'date'],
    'status'                                   => ['title' => 'Status',                                    'type' => 'string'],
    'forwarder_name'                           => ['title' => 'Forwarder Name',                            'type' => 'string'],
    'total_charges'                            => ['title' => 'Total Charges',                             'type' => 'string'],
    'created_by'                               => ['title' => 'Created By',                                'type' => 'string'],
    'updated_by'                               => ['title' => 'Updated By',                                'type' => 'string'],
    'created_at'                               => ['title' => 'Created At',                                'type' => 'date'],
    'updated_at'                               => ['title' => 'Updated At',                                'type' => 'date'],
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














