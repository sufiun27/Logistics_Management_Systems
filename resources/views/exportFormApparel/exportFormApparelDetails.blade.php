@extends('template.index')
@section('content')

<div class="card ">
    <div class="card-header">
        <a href="{{route('exportFormApparel.exportFormApparel')}}" class="btn btn-dark btn-sm">Back</a>
        <a href="{{route('exportFormApparel.exportFormApparelExFactory',$efa->id)}}" class="btn btn-success btn-sm">Ex-Factory</a>
        <a href="{{route('exportFormApparel.exportFormApparelEdit',$efa->id)}}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{route('exportFormApparel.exportFormApparelDelete',$efa->id)}}" class="btn btn-danger btn-sm">Delete</a>
        <a href="{{route('exportFormApparel.exportFormApparelDetailsPdf',$efa->id)}}" target="_blank" class="btn btn-info btn-sm">PDF</a>
    </div>
    <div class="card-title"><h2>Export Form </h2></div>
    <hr>
    
<div class="card-body">

    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-4">Item Name:</dt>
                <dd class="col-sm-8">{{$efa->item_name}}</dd>

                <dt class="col-sm-4">HS Code:</dt>
                <dd class="col-sm-8">{{$efa->hs_code}}</dd>

                <dt class="col-sm-4">Invoice No:</dt>
                <dd class="col-sm-8">{{$efa->invoice_no}}</dd>

                <dt class="col-sm-4">Invoice Date:</dt>
                <dd class="col-sm-8">{{$efa->invoice_date}}</dd>

                <dt class="col-sm-4">Contract No:</dt>
                <dd class="col-sm-8">{{$efa->contract_no}}</dd>

                <dt class="col-sm-4">Contract Date:</dt>
                <dd class="col-sm-8">{{$efa->contract_date}}</dd>


                

            </dl>
        </div>

        <div class="col-md-6">
            <dl class="row">

                <dt class="col-sm-4">Consignee Name:</dt>
                <dd class="col-sm-8">{{$efa->consignee_name}}</dd>

                <dt class="col-sm-4">Consignee Site:</dt>
                <dd class="col-sm-8">{{$efa->consignee_site}}</dd>

                <dt class="col-sm-4">Consignee Address:</dt>
                <dd class="col-sm-8">{{$efa->consignee_address}}</dd>

                <dt class="col-sm-4">DST Country:</dt>
                <dd class="col-sm-8">{{$efa->dst_country_name}}</dd>

                <dt class="col-sm-4">DST Country Port:</dt>
                <dd class="col-sm-8">{{$efa->dst_country_port}}</dd>

                <dt class="col-sm-4">Section:</dt>
                <dd class="col-sm-8">{{$efa->section}}</dd>

                <dt class="col-sm-4">TT No:</dt>
                <dd class="col-sm-8">{{$efa->tt_no}}</dd>

                <dt class="col-sm-4">Local Transport:</dt>
                <dd class="col-sm-8">{{$efa->local_transport}}</dd>

                <dt class="col-sm-4">Site:</dt>
                <dd class="col-sm-8">{{$efa->site}}</dd>

                <dt class="col-sm-4">TT Date:</dt>
                <dd class="col-sm-8">{{$efa->tt_date}}</dd>

                <!-- Add more details as needed -->

            </dl>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                <h4>Quantity & Value </h4>
                <hr>
                <dt class="col-sm-4">Unit:</dt>
                <dd class="col-sm-8">{{$efa->unit}}</dd>

                <dt class="col-sm-4">Quantity:</dt>
                <dd class="col-sm-8">{{$efa->quantity}}</dd>

                <dt class="col-sm-4">Currency:</dt>
                <dd class="col-sm-8">{{$efa->currency}}</dd>

                <dt class="col-sm-4">Amount:</dt>
                <dd class="col-sm-8">{{$efa->amount}}</dd>

                <dt class="col-sm-4">CM Percentage:</dt>
                <dd class="col-sm-8">{{$efa->cm_percentage}}</dd>

                <dt class="col-sm-4">Incoterm:</dt>
                <dd class="col-sm-8">{{$efa->incoterm}}</dd>

                <dt class="col-sm-4">CM Amount:</dt>
                <dd class="col-sm-8">{{$efa->cm_amount}}</dd>

                <dt class="col-sm-4">Freight Value:</dt>
                <dd class="col-sm-8">{{$efa->freight_value}}</dd>

               

                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h4>Ex-Factory Information</h4>
                    <hr>
                    <dt class="col-sm-4">Exp No:</dt>
                    <dd class="col-sm-8">{{$efa->exp_no}}</dd>
    
                    <dt class="col-sm-4">Exp Date:</dt>
                    <dd class="col-sm-8">{{$efa->exp_date}}</dd>
    
                    <dt class="col-sm-4">Exp Permit No:</dt>
                    <dd class="col-sm-8">{{$efa->exp_permit_no}}</dd>
    
                    <dt class="col-sm-4">BL No:</dt>
                    <dd class="col-sm-8">{{$efa->bl_no}}</dd>
    
                    <dt class="col-sm-4">BL Date:</dt>
                    <dd class="col-sm-8">{{$efa->bl_date}}</dd>
    
                    <dt class="col-sm-4">Ex Factory Date:</dt>
                    <dd class="col-sm-8">{{$efa->ex_factory_date}}</dd>

                    <hr>
    
                    <dt class="col-sm-4">Created By:</dt>
                    <dd class="col-sm-8">{{$efa->create_by}}</dd>

                    <dt class="col-sm-4">Created At:</dt>
                    <dd class="col-sm-8">{{$efa->created_at}}</dd>

                    <dt class="col-sm-4">Updated By:</dt>
                    <dd class="col-sm-8">{{$efa->update_by}}</dd>

                    <dt class="col-sm-4">Updated At:</dt>
                    <dd class="col-sm-8">{{$efa->updated_at}}</dd>
                </div>
            </div>

        </div>

    </div>

    <!-- Add more sections and styling as needed -->

</div>
</div>
@endsection
