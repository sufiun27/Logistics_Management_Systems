@extends('template.index')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('exportFormApparel.exportFormApparel') }}" class="btn btn-dark btn-sm">Back</a>
        <a href="{{ route('exportFormApparel.exportFormApparelExFactory', $efa->id) }}" class="btn btn-success btn-sm">Ex-Factory</a>
        <a href="{{ route('exportFormApparel.exportFormApparelEdit', $efa->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('exportFormApparel.exportFormApparelDelete', $efa->id) }}" class="btn btn-danger btn-sm">Delete</a>
        <a href="{{ route('exportFormApparel.exportFormApparelDetailsPdf', $efa->id) }}" target="_blank" class="btn btn-info btn-sm">PDF</a>
    </div>
    <div class="card-title"><h2>Export Form</h2></div>
    <hr>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-4">Item Name:</dt>
                    <dd class="col-sm-8">{{ $efa->item_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">HS Code:</dt>
                    <dd class="col-sm-8">{{ $efa->hs_code ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">HS Code Second:</dt>
                    <dd class="col-sm-8">{{ $efa->hs_code_second ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Invoice No:</dt>
                    <dd class="col-sm-8">{{ $efa->invoice_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Invoice Date:</dt>
                    <dd class="col-sm-8">{{ $efa->invoice_date ? \Illuminate\Support\Carbon::parse($efa->invoice_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Contract No:</dt>
                    <dd class="col-sm-8">{{ $efa->contract_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Contract Date:</dt>
                    <dd class="col-sm-8">{{ $efa->contract_date ? \Illuminate\Support\Carbon::parse($efa->contract_date)->format('Y-m-d') : 'N/A' }}</dd>
                </dl>
            </div>

            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-4">Consignee Name:</dt>
                    <dd class="col-sm-8">{{ $efa->consignee_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Consignee Site:</dt>
                    <dd class="col-sm-8">{{ $efa->consignee_site ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Consignee Address:</dt>
                    <dd class="col-sm-8">{{ $efa->consignee_address ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">DST Country Code:</dt>
                    <dd class="col-sm-8">{{ $efa->dst_country_code ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">DST Country Name:</dt>
                    <dd class="col-sm-8">{{ $efa->dst_country_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">DST Country Port:</dt>
                    <dd class="col-sm-8">{{ $efa->dst_country_port ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Section:</dt>
                    <dd class="col-sm-8">{{ $efa->section ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">TT No:</dt>
                    <dd class="col-sm-8">{{ $efa->tt_no ?? 'N/A' }}</dd>

                    @php
                    use App\Models\Ttinformation;
                        $ttinfo = Ttinformation::where('tt_no', $efa->tt_no)->first();
                    @endphp


                    <dt class="col-sm-4">TT Balance:</dt>
                    <dd class="col-sm-8">{{ $ttinfo ? $ttinfo->balance : 'N/A' }}</dd>

                    <dt class="col-sm-4">TT Date:</dt>
                    <dd class="col-sm-8">{{ (!empty($efa->tt_date) && $efa->tt_date != '0000-00-00' && $efa->tt_date != '1970-01-01') ? \Illuminate\Support\Carbon::parse($efa->tt_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Invoice Site:</dt>
                    <dd class="col-sm-8">{{ $efa->invoice_site ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Quantity & Value</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Unit:</dt>
                    <dd class="col-sm-8">{{ $efa->unit ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Quantity:</dt>
                    <dd class="col-sm-8">{{ $efa->quantity ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Currency:</dt>
                    <dd class="col-sm-8">{{ $efa->currency ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Amount:</dt>
                    <dd class="col-sm-8">{{ isset($efa->amount) ? number_format($efa->amount, 2) : 'N/A' }}</dd>

                    <dt class="col-sm-4">CM Percentage:</dt>
                    <dd class="col-sm-8">{{ isset($efa->cm_percentage) ? number_format($efa->cm_percentage, 2) : 'N/A' }}%</dd>

                    <dt class="col-sm-4">Incoterm:</dt>
                    <dd class="col-sm-8">{{ $efa->incoterm ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">CM Amount:</dt>
                    <dd class="col-sm-8">{{ isset($efa->cm_amount) ? number_format($efa->cm_amount, 2) : 'N/A' }}</dd>

                    <dt class="col-sm-4">Freight Value:</dt>
                    <dd class="col-sm-8">{{ isset($efa->freight_value) ? number_format($efa->freight_value, 2) : 'N/A' }}</dd>

                    <dt class="col-sm-4">FOB Value:</dt>
                    <dd class="col-sm-8">{{ isset($efa->amount) && isset($efa->freight_value) ? number_format($efa->amount - $efa->freight_value, 2) : 'N/A' }}</dd>
                </dl>
            </div>

            <div class="col-md-6">
                <h4>Transport & Notify Information</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Transport Name:</dt>
                    <dd class="col-sm-8">{{ $efa->transport_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Transport Address:</dt>
                    <dd class="col-sm-8">{{ $efa->transport_address ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Transport Port:</dt>
                    <dd class="col-sm-8">{{ $efa->transport_port ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Notify Name:</dt>
                    <dd class="col-sm-8">{{ $efa->notify_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Notify Address:</dt>
                    <dd class="col-sm-8">{{ $efa->notify_address ?? 'N/A' }}</dd>
                </dl>

                <h4>Ex-Factory Information</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Exp No:</dt>
                    <dd class="col-sm-8">{{ $efa->exp_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Exp Date:</dt>
                    <dd class="col-sm-8">{{ $efa->exp_date ? \Illuminate\Support\Carbon::parse($efa->exp_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Exp Permit No:</dt>
                    <dd class="col-sm-8">{{ $efa->exp_permit_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">BL No:</dt>
                    <dd class="col-sm-8">{{ $efa->bl_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">BL Date:</dt>
                    <dd class="col-sm-8">{{ $efa->bl_date ? \Illuminate\Support\Carbon::parse($efa->bl_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Ex Factory Date:</dt>
                    <dd class="col-sm-8">{{ $efa->ex_factory_date ? \Illuminate\Support\Carbon::parse($efa->ex_factory_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Net Wet:</dt>
                    <dd class="col-sm-8">{{ $efa->net_wet ? number_format($efa->net_wet, 2) : 'N/A' }}</dd>

                    <dt class="col-sm-4">Gross Wet:</dt>
                    <dd class="col-sm-8">{{ $efa->gross_wet ? number_format($efa->gross_wet, 2) : 'N/A' }}</dd>
                </dl>

                <h4>Audit Information</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Created By:</dt>
                    <dd class="col-sm-8">{{ $efa->create_by ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Created At:</dt>
                    <dd class="col-sm-8">{{ $efa->created_at ? \Illuminate\Support\Carbon::parse($efa->created_at)->format('Y-m-d H:i:s') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Updated By:</dt>
                    <dd class="col-sm-8">{{ $efa->update_by ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Updated At:</dt>
                    <dd class="col-sm-8">{{ $efa->updated_at ? \Illuminate\Support\Carbon::parse($efa->updated_at)->format('Y-m-d H:i:s') : 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
