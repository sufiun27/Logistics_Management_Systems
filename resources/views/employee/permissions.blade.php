@extends('template.index')

@section('basic_table_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/extra-libs/multicheck/multicheck.css') }}" />
    <link href="{{ asset('matrix/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endsection


@section('content')
    <!-- ==================================================== -->
    <!-- Include this in your Blade view where you want to display messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employee</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-info">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>

                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>site</th>
                                        <th>Factory</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>remarks</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td>{{ $employee->emp_id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->department }}</td>
                                        <td>{{ $employee->site }}</td>
                                        <td>{{ $employee->factory }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>{{ $employee->remarks }}</td>

                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- end row -->
        <!-- ////user permission table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Granted Permission List</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm p-0 m-0">
                        <thead class="table-info">
                            <tr>
                                <th>Modeule</th>
                                <th>Name</th>
                                <th>description</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                // Define the single, dynamic map of colors to permission arrays
                                $permission_groups = [
                                    '#7CF7CC' => [
                                        'consignee_manage',
                                        'dest_country_manage',
                                        'tt_manage',
                                        'transport_manage',
                                        'export_manage',
                                    ], // Green List
                                    '#7CE5F7' => ['logistics_manage'], // Light Blue List
                                    '#E5F77C' => ['sales_manage'], // Yellow List
                                    '#7CA7F7' => ['billing_manage'], // Blue List
                                    '#F78E7C' => ['cm_percentage', 'emp_manage', 'emp_permissions', 'exporter_manage'], // Red/Danger List
                                    '#C4B4FF' => ['shipping_manage'], // Orange List
                                ];

                                // Define a default color for any permission not found in the lists
                                $default_color = '#FFFFFF'; // White or a light neutral color
                            @endphp




                            @foreach ($user_permissions as $user_permissions)
                                @php
                                    $bgColor = $default_color; // Start with the default color

                                    // Iterate over the associative array to find a matching color
                                    foreach ($permission_groups as $color => $list) {
                                        if (in_array($user_permissions->permission->name, $list)) {
                                            $bgColor = $color;
                                            break; // Found the color, stop checking the other lists
                                        }
                                    }
                                @endphp

                                <tr style="background-color: {{ $bgColor }};">
                                    <td>{{ $user_permissions->permission->module }}</td>
                                    <td>{{ $user_permissions->permission->name }}</td>
                                    <td>{{ $user_permissions->permission->description }}</td>

                                    <td class="{{ $user_permissions->status == 1 ? 'table-success' : 'table-danger' }}">
                                        {{ $user_permissions->status == 1 ? 'Active' : 'Deactive' }}
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-xs"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-table-edit"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center"><a class="dropdown-item btn btn-xs bg-success"
                                                        href="{{ route('employee.permissions.activate', ['id' => $user_permissions->id]) }}">Active</a>
                                                </li>
                                                <li class="text-center"><a class="dropdown-item btn btn-xs bg-warning"
                                                        href="{{ route('employee.permissions.deactivate', ['id' => $user_permissions->id]) }}">Deactive</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li class="text-center"><a class="dropdown-item btn btn-xs bg-danger"
                                                        href="{{ route('employee.permissions.remove', ['id' => $user_permissions->id]) }}">Remove</a>
                                                </li>
                                            </ul>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>



                    <!-- ////Give permission table -->
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Permission List</h5>
                                    <div class="table-responsive">
                                        <table id="zero_config"
                                            class="table table-striped table-bordered table-sm p-0 m-0">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th>Modeule</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <tbody>
                                                @php
                                                    // Define the single, dynamic map of colors to permission arrays
                                                    $permission_groups = [
                                                        '#7CF7CC' => [
                                                            'consignee_manage',
                                                            'dest_country_manage',
                                                            'tt_manage',
                                                            'transport_manage',
                                                            'export_manage',
                                                        ], // Green List
                                                        '#7CE5F7' => ['logistics_manage'], // Light Blue List
                                                        '#E5F77C' => ['sales_manage'], // Yellow List
                                                        '#7CA7F7' => ['billing_manage'], // Blue List
                                                        '#F78E7C' => [
                                                            'cm_percentage',
                                                            'emp_manage',
                                                            'emp_permissions',
                                                            'exporter_manage',
                                                        ], // Red/Danger List
                                                        '#C4B4FF' => ['shipping_manage'], // Orange List
                                                    ];

                                                    // Define a default color for any permission not found in the lists
                                                    $default_color = '#FFFFFF'; // White or a light neutral color
                                                @endphp

                                                @foreach ($permissions as $permission)
                                                    @php
                                                        $bgColor = $default_color; // Start with the default color

                                                        // Iterate over the associative array to find a matching color
                                                        foreach ($permission_groups as $color => $list) {
                                                            if (in_array($permission->name, $list)) {
                                                                $bgColor = $color;
                                                                break; // Found the color, stop checking the other lists
                                                            }
                                                        }
                                                    @endphp

                                                    <tr style="background-color: {{ $bgColor }};">
                                                        {{-- Changed $permissions to $permission for clarity --}}
                                                        <td>{{ $permission->module }}</td>
                                                        <td>{{ $permission->name }}</td>
                                                        <td>{{ $permission->description }}</td>
                                                        <td>
                                                            <a href="{{ route('employee.permissions.add', ['e_id' => $employee->id, 'p_id' => $permission->id]) }}"
                                                                class="btn btn-success py-0 px-4 m-0 rounded-pill">
                                                                <i class="fa fa-plus"></i> Add
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </tbody>
                                            {{-- <tfoot>
                        <tr>
                        <th>Module</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                        </tr>
                      </tfoot> --}}
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                    <!-- ============================================================== -->
                    <!-- End Right sidebar -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            @endsection

            @section('basic_table')
                <!-- this page js -->
                <script src="{{ asset('matrix/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
                <script src="{{ asset('matrix/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
                <script src="{{ asset('matrix/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
                <script>
                    /****************************************
                     *       Basic Table                   *
                     ****************************************/
                    $("#zero_config").DataTable();
                </script>
            @endsection
