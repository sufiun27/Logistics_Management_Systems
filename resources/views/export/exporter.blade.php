@extends('template.index')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Exporters</h5>
        <a href="{{ route('export.addExporter') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    <div class="card-body">

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Display Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm align-middle">
                <thead class="table-danger">
                    <tr>
                        <th>Exporter No</th>
                        <th>Exporter Name</th>
                        <th>Exporter Address</th>
                        <th>Registration Details</th>
                        <th>EPB.REG</th>
                        <th class="text-center" style="width: 80px;">Edit</th>
                        <th class="text-center" style="width: 80px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exporters as $exporter)
                        <tr>
                            <td>{{ $exporter->ExpoterNo }}</td>
                            <td>{{ $exporter->ExpoterName }}</td>
                            <td>{{ $exporter->ExpoterAddress }}</td>
                            <td>{{ $exporter->RegDetails }}</td>
                            <td>{{ $exporter->EPBReg }}</td>
                            <td class="text-center">
                                <a href="{{ route('export.editExporter', $exporter->id) }}" class="btn btn-info btn-sm">Edit</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('export.deleteExporter', $exporter->id) }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this exporter?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No exporters found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination (if you use paginate) --}}
        @if(method_exists($exporters, 'links'))
            <div class="mt-3">
                {{ $exporters->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
