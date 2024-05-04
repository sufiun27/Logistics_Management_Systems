@extends('template.index')
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route('DestCountry.DestCountry')}}" class="btn btn-success btn-sm">Back</a>
    </div>
    <div class="card-body">
        <x-message/>
        <p>Add Destination Country</p>
        <form action="{{route('DestCountry.storeDestCountry')}}" method="post">
            @csrf
            <input type="text" name="country_code" placeholder="Country Code" value="{{ old('country_code') }}" class="form-control"><br>
            <input type="text" name="country_name" placeholder="Country Name" value="{{old('country_name')}}" class="form-control"><br>
            <input type="text" name="port" placeholder="Port" class="form-control" value="{{old('port')}}"><br>
            <input type="submit" value="Save" class="btn btn-primary btn-sm">
        </form>
    </div>
</div>
@endsection

