@extends('template.index')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{route('export.addExporter')}}" class="btn btn-success btn-sm">Add New</a>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="card-body">
        {{-- {{$exporters}} --}}
        <table class="table table-striped table-sm">
            <thead class="table-danger">
                
                    
                        <tr>
                            <th><b>Exporter No</b></th>
                            <th><b>Exporter Name</b></th>
                            <th><b>Exporter Address</b></th>
                            <th><b>Registration Details</b></th>
                            <th><b>EPB.REG</b></th>
                            <th colspan="2""><b>Action</b></th>
                            </tr>
                    </thead>
                
            </thead>
            <tbody>
                @foreach($exporters as $exporters)
                <tr>
                    
                    <td>{{$exporters->ExpoterNo}}</td>
                    <td>{{$exporters->ExpoterName}}</td>
                    <td>{{$exporters->ExpoterAddress}}</td>
                    <td>{{$exporters->RegDetails}}</td>
                    <td>{{$exporters->EPBReg}}</td>
                    <td ><a href="{{ route('export.editExporter', $exporters->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td><a href="{{ route('export.deleteExporter', $exporters->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection