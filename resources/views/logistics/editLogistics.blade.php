@extends('template.index')
@section('content')
    <div class="card">
        
        <div class="card-header">
            <label for="invoice_no">Invoice No: </label>
            <input id="invoice_no" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <div id="invoices"></div>
        </div>

        <div class="card-title">
            <a href="{{route('logistics.indexLogistics')}}" class="btn btn-success">Back</a> 
            <a href="{{route('logistics.deleteLogistics',$l->id)}}" class="btn btn-danger">Delete</a>
            <x-message/>
        </div>


            <form class="form-horizontal" action="{{route('logistics.updateLogistics',$l->id)}}"  method="POST"> {{----}}
                @csrf
                
                <div class="row ">
                    <div class="col-6 ">
                        <hr>
                        <h3>&nbsp;&nbsp; Custom Related Cost Entry</h3>
                        <hr>
                        <div class="form-group row">
                            <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label">Invoice No:</label>
                            <div class="col-sm-9">
                            <div id="displayDiv">
                                <input type="text" readonly name="invoice_no" class="form-control" id="invoice_no" placeholder="Invoice No" value="{{ $l->invoice_no }}" required />
                            </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="receivable_amount" class="col-sm-3 text-end control-label col-form-label">Receivable Amount:</label>
                            <div class="col-sm-9">
                                <input type="text" name="receivable_amount"  class="form-control" id="receivable_amount" placeholder="Receivable Amount" value="{{ $l->receivable_amount }}" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="doc_process_fee" class="col-sm-3 text-end control-label col-form-label">Doc Process Fee:</label>
                            <div class="col-sm-9">
                                <input type="text" name="doc_process_fee" class="form-control" id="doc_process_fee" placeholder="Doc Process Fee" value="{{ $l->doc_process_fee }}" />
                            </div>
                        </div>
    
            </div>
            
            <div class="col-6">
                        <hr>
                        <h3>&nbsp;&nbsp; Export Charge Entry</h3>
                        <hr>
                <div class="form-group row">
                    <label for="seal_lock_charge" class="col-sm-3 text-end control-label col-form-label">Seal Lock Charge:</label>
                    <div class="col-sm-9">
                        <input type="text" name="seal_lock_charge" class="form-control" id="seal_lock_charge" placeholder="Seal Lock Charge" value="{{ $l->seal_lock_charge }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="agency_commission" class="col-sm-3 text-end control-label col-form-label">Agency Commission:</label>
                    <div class="col-sm-9">
                        <input type="text" name="agency_commission" class="form-control" id="agency_commission" placeholder="Agency Commission" value="{{ $l->agency_commission }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="documentation_charge" class="col-sm-3 text-end control-label col-form-label">Documentation Charge:</label>
                    <div class="col-sm-9">
                        <input type="text" name="documentation_charge" class="form-control" id="documentation_charge" placeholder="Documentation Charge" value="{{ $l->documentation_charge }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="transportation_charge" class="col-sm-3 text-end control-label col-form-label">Transportation Charge:</label>
                    <div class="col-sm-9">
                        <input type="text" name="transportation_charge" class="form-control" id="transportation_charge" placeholder="Transportation Charge" value="{{ $l->transportation_charge }}" />
                    </div>
                </div>
                
            </div>

            <div class="col-6">
                <hr>
                <h3>&nbsp;&nbsp; Other Charge</h3>
                <hr>
                
                <div class="form-group row">
                    <label for="short_shipment_certificate_fee" class="col-sm-3 text-end control-label col-form-label">Short Shipment Certificate Fee:</label>
                    <div class="col-sm-9">
                        <input type="text" name="short_shipment_certificate_fee" class="form-control" id="short_shipment_certificate_fee" placeholder="Short Shipment Certificate Fee" value="{{ $l->short_shipment_certificate_fee }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="factory_loading_fee" class="col-sm-3 text-end control-label col-form-label">Factory Loading Fee:</label>
                    <div class="col-sm-9">
                        <input type="text" name="factory_loading_fee" class="form-control" id="factory_loading_fee" placeholder="Factory Loading Fee" value="{{ $l->factory_loading_fee }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="uploading_fee_forwarder_wh" class="col-sm-3 text-end control-label col-form-label">Uploading Fee Forwarder WH:</label>
                    <div class="col-sm-9">
                        <input type="text" name="uploading_fee_forwarder_wh" class="form-control" id="uploading_fee_forwarder_wh" placeholder="Uploading Fee Forwarder WH" value="{{ $l->uploading_fee_forwarder_wh }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="truck_demurrage_fee_delay_at_depot" class="col-sm-3 text-end control-label col-form-label">Truck Demurrage Fee Delay at Depot:</label>
                    <div class="col-sm-9">
                        <input type="text" name="truck_demurrage_fee_delay_at_depot" class="form-control" id="truck_demurrage_fee_delay_at_depot" placeholder="Truck Demurrage Fee Delay at Depot" value="{{ $l->truck_demurrage_fee_delay_at_depot }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="cfs_depot_mixed_cargo_loading_fee" class="col-sm-3 text-end control-label col-form-label">CFS Depot Mixed Cargo Loading Fee:</label>
                    <div class="col-sm-9">
                        <input type="text" name="cfs_depot_mixed_cargo_loading_fee" class="form-control" id="cfs_depot_mixed_cargo_loading_fee" placeholder="CFS Depot Mixed Cargo Loading Fee" value="{{ $l->cfs_depot_mixed_cargo_loading_fee }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="customs_misc_remark_reasons_charge" class="col-sm-3 text-end control-label col-form-label">Customs Misc Remark Reasons Charge:</label>
                    <div class="col-sm-9">
                        <input type="text" name="customs_misc_remark_reasons_charge" class="form-control" id="customs_misc_remark_reasons_charge" placeholder="Customs Misc Remark Reasons Charge" value="{{ $l->customs_misc_remark_reasons_charge }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="customs_remark_charge_misc_reasons" class="col-sm-3 text-end control-label col-form-label">Customs Remark Charge Misc Reasons:</label>
                    <div class="col-sm-9">
                        <input type="text" name="customs_remark_charge_misc_reasons" class="form-control" id="customs_remark_charge_misc_reasons" placeholder="Customs Remark Charge Misc Reasons" value="{{ $l->customs_remark_charge_misc_reasons }}" />
                    </div>
                </div>
                

            </div>

            <div class="col-6">
                <hr>
                <h3>&nbsp;&nbsp; Date Information</h3>
                <hr>
                
                <div class="form-group row">
                    <label for="cargo_ho_date" class="col-sm-3 text-end control-label col-form-label">Cargo HO Date:</label>
                    <div class="col-sm-9">
                        <input type="date" name="cargo_ho_date" class="form-control" id="cargo_ho_date" placeholder="Cargo HO Date" value="{{ $l->cargo_ho_date }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="deadline_bill_submission" class="col-sm-3 text-end control-label col-form-label">Deadline for Bill Submission:</label>
                    <div class="col-sm-9">
                        <input type="date" name="deadline_bill_submission" class="form-control" id="deadline_bill_submission" placeholder="Deadline for Bill Submission" value="{{ $l->deadline_bill_submission }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="bill_received_date" class="col-sm-3 text-end control-label col-form-label">Bill Received Date:</label>
                    <div class="col-sm-9">
                        <input type="date" name="bill_received_date" class="form-control" id="bill_received_date" placeholder="Bill Received Date" value="{{ $l->bill_received_date }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="status" class="col-sm-3 text-end control-label col-form-label">Status:</label>
                    <div class="col-sm-9">
                        <input type="text" name="status" class="form-control" id="status" placeholder="Status" value="{{ $l->status }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="forwarder_name" class="col-sm-3 text-end control-label col-form-label">Forwarder Name:</label>
                    <div class="col-sm-9">
                        <input type="text" name="forwarder_name" class="form-control" id="forwarder_name" placeholder="Forwarder Name" value="{{ $l->forwarder_name }}" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="total_charges" class="col-sm-3 text-end control-label col-form-label">Total Charges:</label>
                    <div class="col-sm-9">
                        <input type="text" readonly name="total_charges" class="form-control" id="total_charges" placeholder="Total Charges" value="{{ $l->total_charges }}" />
                    </div>
                </div>
                
                
            </div>


            <div class="border-top"> <div class="card-body"> 
                <input type="submit" value="Save" class="btn btn-primary">
            </div> 
           
        </form>

            
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   

<script>
    $(document).ready(function() {
        // Function to update total charges when any relevant field changes
        function updateTotalCharges() {
            // Extract values from input fields, defaulting to 0 if empty
            var receivableAmount = parseFloat($('#receivable_amount').val()) || 0;
            var docProcessFee = parseFloat($('#doc_process_fee').val()) || 0;
            var sealLockCharge = parseFloat($('#seal_lock_charge').val()) || 0;
            var agencyCommission = parseFloat($('#agency_commission').val()) || 0;
            var documentationCharge = parseFloat($('#documentation_charge').val()) || 0;
            var transportationCharge = parseFloat($('#transportation_charge').val()) || 0;
            var shortShipmentCertificateFee = parseFloat($('#short_shipment_certificate_fee').val()) || 0;
            var factoryLoadingFee = parseFloat($('#factory_loading_fee').val()) || 0;
            var uploadingFeeForwarderWH = parseFloat($('#uploading_fee_forwarder_wh').val()) || 0;
            var truckDemurrageFeeDelayAtDepot = parseFloat($('#truck_demurrage_fee_delay_at_depot').val()) || 0;
            var cfsDepotMixedCargoLoadingFee = parseFloat($('#cfs_depot_mixed_cargo_loading_fee').val()) || 0;
            var customsMiscRemarkReasonsCharge = parseFloat($('#customs_misc_remark_reasons_charge').val()) || 0;
            var customsRemarkChargeMiscReasons = parseFloat($('#customs_remark_charge_misc_reasons').val()) || 0;

            // Calculate total charges
            var totalCharges = receivableAmount + docProcessFee + sealLockCharge + agencyCommission +
                documentationCharge + transportationCharge + shortShipmentCertificateFee +
                factoryLoadingFee + uploadingFeeForwarderWH + truckDemurrageFeeDelayAtDepot +
                cfsDepotMixedCargoLoadingFee + customsMiscRemarkReasonsCharge+customsRemarkChargeMiscReasons;

            // Update the total_charges field
            $('#total_charges').val(totalCharges.toFixed(2));
        }

        // Attach the updateTotalCharges function to the change event of relevant fields
        $('#receivable_amount, #doc_process_fee, #seal_lock_charge, #agency_commission, #documentation_charge, #transportation_charge, #short_shipment_certificate_fee, #factory_loading_fee, #uploading_fee_forwarder_wh, #truck_demurrage_fee_delay_at_depot, #cfs_depot_mixed_cargo_loading_fee, #customs_misc_remark_reasons_charge, #customs_remark_charge_misc_reasons').on('change', function() {
            updateTotalCharges();
        });

        // Initial calculation on page load
        updateTotalCharges();
    });
</script>

@endsection