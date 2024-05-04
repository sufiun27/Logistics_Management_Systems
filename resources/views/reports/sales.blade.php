@extends('template.index')

@section('yajra_datatable_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link href='https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection

@section('content')

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Selse Report</div>
                    <x-message/>
                </div>
                <div class="card-body ">

                    <form action="{{ route('reports.sales') }}" method="GET"> {{----}}
                        @csrf
                        <div class="form-group row">
    
                            <label for="start_date" class="col-sm-2 col-form-label text-end">Start Date:</label>
                            <div class="col-sm-2">
                                <input type="date" name="start_date" class="form-control">
                            </div>
    
                            <label for="end_date" class="col-sm-2 col-form-label text-end">End Date:</label>
                            <div class="col-sm-2">
                                <input type="date" name="end_date" class="form-control">
                            </div>
    
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                            </div>                        
    
                        </div>
                    
                    </form>

                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                    
                </div>
            </div>
            

@endsection

@section('yajra_datatable_js')
    <!-- Yajra Datatables Scripts -->
    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Yajra Datatables Buttons Scripts -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <!-- Yajra Datatables Laravel Scripts -->
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection



