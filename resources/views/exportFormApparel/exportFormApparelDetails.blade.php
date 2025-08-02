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
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->item_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">HS Code:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->hs_code ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">HS Code Second:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->hs_code_second ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Invoice No:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->invoice_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Invoice Date:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->invoice_date ? \Illuminate\Support\Carbon::parse($efa->invoice_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Contract No:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->contract_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Contract Date:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->contract_date ? \Illuminate\Support\Carbon::parse($efa->contract_date)->format('Y-m-d') : 'N/A' }}</dd>
                </dl>
            </div>

            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-4">Consignee Name:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->consignee_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Consignee Site:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->consignee_site ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Consignee Address:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->consignee_address ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">DST Country Code:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->dst_country_code ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">DST Country Name:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->dst_country_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">DST Country Port:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->dst_country_port ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Section:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->section ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">TT No:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->tt_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">TT Date:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">
                        {{ (!empty($efa->tt_date) && $efa->tt_date != '0000-00-00' && $efa->tt_date != '1970-01-01') ? \Illuminate\Support\Carbon::parse($efa->tt_date)->format('Y-m-d') : 'N/A' }}
                    </dd>

                    <dt class="col-sm-4">Invoice Site:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->invoice_site ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Quantity & Value</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Unit:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->unit ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Quantity:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->quantity ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Currency:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->currency ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Amount:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ isset($efa->amount) ? number_format($efa->amount, 4) : 'N/A' }}</dd>

                    <dt class="col-sm-4">CM Percentage:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ isset($efa->cm_percentage) ? number_format($efa->cm_percentage, 2) : 'N/A' }}%</dd>

                    <dt class="col-sm-4">Incoterm:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->incoterm ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">CM Amount:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ isset($efa->cm_amount) ? number_format($efa->cm_amount, 4) : 'N/A' }}</dd>

                    <dt class="col-sm-4">Freight Value:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ isset($efa->freight_value) ? number_format($efa->freight_value, 4) : 'N/A' }}</dd>

                    <dt class="col-sm-4">FOB Value:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ isset($efa->amount) && isset($efa->freight_value) ? number_format($efa->amount - $efa->freight_value, 4) : 'N/A' }}</dd>
                </dl>
            </div>

            <div class="col-md-6">
                <h4>Transport & Notify Information</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Transport Name:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->transport_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Transport Address:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->transport_address ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Transport Port:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->transport_port ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Notify Name:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->notify_name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Notify Address:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->notify_address ?? 'N/A' }}</dd>
                </dl>

                <h4>Ex-Factory Information</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Exp No:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->exp_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Exp Date:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->exp_date ? \Illuminate\Support\Carbon::parse($efa->exp_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Exp Permit No:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->exp_permit_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">BL No:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->bl_no ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">BL Date:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->bl_date ? \Illuminate\Support\Carbon::parse($efa->bl_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Ex Factory Date:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->ex_factory_date ? \Illuminate\Support\Carbon::parse($efa->ex_factory_date)->format('Y-m-d') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Net Wet:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->net_wet ? number_format($efa->net_wet, 4) : 'N/A' }}</dd>

                    <dt class="col-sm-4">Gross Wet:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->gross_wet ? number_format($efa->gross_wet, 4) : 'N/A' }}</dd>

                </dl>

                <h4>Audit Information</h4>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Created By:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->create_by ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Created At:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->created_at ? \Illuminate\Support\Carbon::parse($efa->created_at)->format('Y-m-d H:i:s') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Updated By:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->update_by ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Updated At:</dt>
                    <dd class="col-sm-8 copyable" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to copy">{{ $efa->updated_at ? \Illuminate\Support\Carbon::parse($efa->updated_at)->format('Y-m-d H:i:s') : 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
    <div id="copyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Value copied to clipboard!
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if Bootstrap is available
        if (typeof bootstrap === 'undefined') {
            console.error('Bootstrap JavaScript is not loaded. Copy functionality and tooltips may not work.');
            alert('Bootstrap JavaScript is not loaded. Please ensure it is included in the page.');
            return;
        }

        const copyableElements = document.querySelectorAll('.copyable');
        const copyToastElement = document.getElementById('copyToast');
        const copyToast = new bootstrap.Toast(copyToastElement, {
            autohide: true,
            delay: 2000
        });

        // Initialize tooltips
        copyableElements.forEach(element => {
            new bootstrap.Tooltip(element, {
                title: 'Click to copy',
                placement: 'top'
            });
        });

        // Use event delegation for dynamically added elements
        document.body.addEventListener('click', function (event) {
            console.log('click done');
            const element = event.target.closest('.copyable');
            if (!element) return;

            const text = element.textContent.trim();
            if (text === 'N/A' || text === '') {
                console.log('Cannot copy "N/A" or empty text.');
                return;
            }

            // Copy using Clipboard API
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showCopiedFeedback(element, copyToast);
                }).catch(err => {
                    console.error('Clipboard API failed:', err);
                    alert('Failed to copy text. Ensure you are using a secure connection (HTTPS).');
                });
            } else {
                // Fallback for non-secure contexts or older browsers
                const textarea = document.createElement('textarea');
                textarea.value = text;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                document.body.appendChild(textarea);
                textarea.focus();
                textarea.select();

                try {
                    document.execCommand('copy');
                    showCopiedFeedback(element, copyToast);
                } catch (err) {
                    console.error('Fallback copy failed:', err);
                    alert('Your browser does not support automatic copying. Please copy manually: ' + text);
                } finally {
                    document.body.removeChild(textarea);
                }
            }
        });

        function showCopiedFeedback(element, toast) {
            const currentTooltip = bootstrap.Tooltip.getInstance(element);
            if (currentTooltip) {
                currentTooltip.dispose();
            }
            const newTooltip = new bootstrap.Tooltip(element, {
                title: 'Copied!',
                placement: 'top',
                trigger: 'manual'
            });
            newTooltip.show();
            toast.show();

            setTimeout(() => {
                newTooltip.hide();
                newTooltip.dispose();
                new bootstrap.Tooltip(element, {
                    title: 'Click to copy',
                    placement: 'top'
                });
            }, 800);
        }
    });
</script>
@endsection

@section('scripts')

@endsection

@push('styles')
<style>
    .copyable {
        cursor: copy;
        transition: background-color 0.2s, color 0.2s;
        padding: 2px 5px;
        display: inline-block;
        border-bottom: 1px dashed #ced4da;
    }
    .copyable:hover {
        background-color: #e2e6ea;
        color: #0056b3;
        border-color: #0056b3;
        border-radius: 4px;
    }
</style>
@endpush
