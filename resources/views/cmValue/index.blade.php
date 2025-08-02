@extends('template.index')

@section('content')
@php
    $exporters = \App\Models\Export::all();
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CM Value</h4>
                    <div class="mb-3">
                        <form action="{{ route('cmValue.store') }}" method="POST" class="row g-2">
                            @csrf
                            <div class="col-md-4">
                                <select name="invoice_site" id="invoice_site" class="form-control" required>
                                    <option value="">Select Exporter</option>
                                    @php
                                        $selectedSite = old('invoice_site');
                                    @endphp
                                    @foreach($exporters as $exporter)
                                        <option value="{{ $exporter->ExpoterName }}" {{ $selectedSite == $exporter->ExpoterName ? 'selected' : '' }}>
                                            {{ $exporter->ExpoterName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="cm_value" step="0.01" min="0" class="form-control" placeholder="CM Value %" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Percentage</th>
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cmValues as $cmValue)
                                    <tr>
                                        <form action="{{ route('cmValue.update', $cmValue->id) }}" method="POST">
                                            @csrf
                                            <td>{{ $cmValue->site }}</td>
                                            <td>
                                                <input type="number" name="cm_value" step="0.01" min="0" class="form-control" 
                                                       value="{{ $cmValue->cm_value }}" required>
                                            </td>
                                            <td>%</td>
                                            <td>
                                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
