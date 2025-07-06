@extends('template.index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CM Value</h4>
                    <div class="table-responsive">
                        <form action="{{ route('cmValue.update', $cmValue->id) }}" method="POST">
                            @csrf
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>percentage</th>
                                        <th></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="number" name="cm_value" step="0.01" min="0" class="form-control" value="{{ $cmValue->cm_value }}" required>
                                        </td>
                                        <td>%</td>
                                        <td>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
