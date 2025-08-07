@extends('template.index')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Destination Countries</h5>
        <a href="{{ route('DestCountry.addDestCountry') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    <div class="card-body">
        <x-message/>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Code</th>
                        <th>Country</th>
                        <th>Port</th>
                        <th class="text-center" style="width: 80px;">Edit</th>
                        <th class="text-center" style="width: 80px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($destcountries as $destcountry)
                        <tr>
                            <td>{{ $destcountry->country_code }}</td>
                            <td>{{ $destcountry->country_name }}</td>
                            <td>{{ $destcountry->port }}</td>
                            <td class="text-center">
                                <a href="{{ route('DestCountry.editDestCountry', $destcountry->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('DestCountry.deleteDestCountry', $destcountry->id) }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this destination country?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No destination countries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Optional pagination --}}
        @if(method_exists($destcountries, 'links'))
            <div class="mt-3">
                {{ $destcountries->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
