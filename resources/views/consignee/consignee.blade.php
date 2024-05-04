@extends('template.index')
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route('consignee.addConsignee')}}" class="btn btn-success btn-sm">Add New</a>
    </div>
    <div class="card-body">
        <x-message/>
        <p>Consignee Details</p>
        <table class="table table-striped table-sm">
            <tr class="table-info">
                <th>Name</th>
                <th>Site</th>
                <th>Address</th>
                <th>Country</th>
                <th colspan="2" >action</th>
            </tr>
            @foreach($consignees as $consignee)
            <tr>
                <td>{{$consignee->consignee_name}}</td>
                <td>{{$consignee->consignee_site}}</td>
                <td>{{$consignee->consignee_address}}</td>
                <td>{{$consignee->consignee_country}}</td>
                <td><a href="{{route('consignee.editConsignee',$consignee->id)}}" class="btn btn-warning btn-sm">Edit</a></td>
                <td><a href="{{route('consignee.deleteConsignee',$consignee->id)}}"class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

