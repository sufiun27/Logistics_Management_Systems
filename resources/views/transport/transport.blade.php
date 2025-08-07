@extends('template.index')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Transport Details</h5>
        <a href="{{ route('transport.addTransport') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    <div class="card-body">
        <x-message/>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm align-middle">
                <thead class="table-info">
                    <tr>
                        <th>Transport Name</th>
                        <th>Transport Address</th>
                        <th>Transport Port</th>
                        <th class="text-center" style="width: 80px;">Edit</th>
                        <th class="text-center" style="width: 80px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transports as $transport)
                    <tr>
                        <td>{{ $transport->name }}</td>
                        <td>{{ $transport->address }}</td>
                        <td>{{ $transport->port }}</td>
                        <td class="text-center">
                            <a href="{{ route('transport.editTransport', $transport->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('transport.deleteTransport', $transport->id) }}" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this transport?')">
                               Delete
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No transport records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Optional pagination --}}
        @if(method_exists($transports, 'links'))
        <div class="mt-3">
            {{ $transports->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
