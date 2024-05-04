@extends('template.index')
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route('DestCountry.addDestCountry')}}" class="btn btn-success btn-sm">Add New</a>
    </div>
    <div class="card-body">
        <x-message/>
        <p>Destination Country</p>
        <table class="table table-striped">
            <tr>
                <th>Code</th>
                <th>Country</th>
                <th>port</th>
                <th colspan="2">action</th>
            </tr>
            @foreach($destcountries as $destcountry)
            <tr>
                <td>{{$destcountry->country_code}}</td>
                <td>{{$destcountry->country_name}}</td>
                <td>{{$destcountry->port}}</td>
                <td><a href="{{route('DestCountry.editDestCountry',$destcountry->id)}}" class="btn btn-warning btn-sm">Edit</a></td>
                <td><a href="{{route('DestCountry.deleteDestCountry',$destcountry->id)}}"class="btn btn-danger btn-sm">Delete</a></td>                     
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

