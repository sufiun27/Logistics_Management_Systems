@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('ttInformation.ttInformation') }}" class="btn btn-dark btn-sm">Back</a>
        <a href="{{ route('ttInformation.editTtInformation', $tt->id) }}" class="btn btn-info btn-sm">Edit</a>
        <a href="{{ route('ttInformation.active',$tt->id) }}" class="btn btn-success btn-sm">Active</a>
        <a href="{{ route('ttInformation.deactive',$tt->id) }}" class="btn btn-warning btn-sm">Deactive</a>
        <a href="{{ route('ttInformation.deleteTtInformation',$tt->id) }}" class="btn btn-danger btn-sm">Delete</a>
    </div>

        <div class="card-body">
            <h4 class="card-title">TT Details information</h4>
            <x-message/>
            <hr>
            <br>
            <div class="row">
                <div class="col-4"><h4>TT No: {{$tt->tt_no}}</h4></div>
                <div class="col-4"><h4>Currency: {{$tt->tt_currency}}</h4></div>
                <div class="col-4"><h4>Amount: {{$tt->tt_amount}}</h4></div>
                <div class="col-4"><h4>Used : {{$tt->tt_used_amount}}</h4></div>
                <div class="col-4"><h4>Bank : {{$tt->bank_name}}</h4></div>
                <div class="col-4"><h4>Site : {{$tt->tt_site}}</h4></div>
                <div class="col-4"><h4>Date : {{$tt->tt_date}}</h4></div>
                <div class="col-4"><h4>Created By : {{$tt->tt_created_by}}</h4></div>
                <div class="col-4"><h4>Created At : {{$tt->created_at}}</h4></div>
                <div class="col-4"><h4>Modified By : {{$tt->Modified_by}}</h4></div>
                <div class="col-4"><h4>Updated At : {{$tt->updated_at}}</h4></div>
                <div class="col-4"><h4>Status : {{$tt->tt_status==1?'Active':'Deactive'}}</h4></div>
                <div class="col-4"><h4>Remarks : {{$tt->tt_remarks}}</h4></div>
            </div>
            <hr>
            <br>
            <h4>there will be related invoice informations</h4>


    </div>
</div>

@endsection
