@extends('template.index')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Consignee Details</h5>
        <a href="{{ route('consignee.addConsignee') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    <div class="card-body">
        <x-message />

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm align-middle">
                <thead class="table-info">
                    <tr>
                        <th>Name</th>
                        <th>Site</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th class="text-center" style="width: 80px;">Edit</th>
                        <th class="text-center" style="width: 80px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consignees as $consignee)
                        <tr>
                            <td>{{ $consignee->consignee_name }}</td>
                            <td>{{ $consignee->consignee_site }}</td>
                            <td>{{ $consignee->consignee_address }}</td>
                            <td>{{ $consignee->consignee_country }}</td>
                            <td class="text-center">
                                <a href="{{ route('consignee.editConsignee', $consignee->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('consignee.deleteConsignee', $consignee->id) }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this consignee?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No consignees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $consignees->links() }}
        </div>
    </div>
</div>
@endsection
