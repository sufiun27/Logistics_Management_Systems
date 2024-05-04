@extends('template.index')
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route('transport.addTransport')}}" class="btn btn-success btn-sm">Add New</a>
    </div>
    <div class="card-body">
        <x-message/>
        <p>Transport Details</p>
        <table class="table table-striped table-sm">
            <tr class="table-info">
                <th>Transport Name</th>
                <th>Transport Address</th>
                <th>Transport Port</th>
                <th colspan="2" >action</th>
            </tr>
            @foreach($transports as $transport)
            <tr>
                <td>{{$transport->name}}</td>
                <td>{{$transport->address}}</td>
                <td>{{$transport->port}}</td>
                <td><a href="{{route('transport.editTransport',$transport->id)}}" class="btn btn-warning btn-sm">Edit</a></td>
                <td><a href="{{route('transport.deleteTransport',$transport->id)}}"class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

