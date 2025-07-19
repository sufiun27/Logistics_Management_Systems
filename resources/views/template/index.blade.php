<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta
      name="description"
      content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Logistics Management System </title>


    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="https://www.hoplun.com/storage/app/uploads/public/5ca/4d6/3d4/5ca4d63d4d92b995796472.jpg"
    />
   <!--//////Boostrap 5-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
   rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- //////basic table css////////////// -->
    @yield('basic_table_css')
    @yield('yajra_datatable_css')
    <!-- /////////////////////////////// -->

    <!-- Custom CSS -->
    <link href="{{asset('matrix/assets/libs/flot/css/float-chart.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('matrix/dist/css/style.min.css')}}" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      <!-- boostrap 5 links -->
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script> -->
      <!-- boostrap 5 links -->


      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



      @stack('styles')

  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{route('dashboard.dashboard')}}">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="https://www.hoplun.com/storage/app/uploads/public/5ca/4d6/3d4/5ca4d63d4d92b995796472.jpg"
                  alt="homepage"
                  class="light-logo"
                  width="25"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                {{-- <img
                  src="{{asset('matrix/assets/images/logo-text.png')}}"
                  alt="homepage"
                  class="light-logo"
                /> --}}
                <b><h1>Hop Lun</h1></b>
              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
              <!-- ============================================================== -->
              <!-- create new -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <span class="text-light">{{ auth()->user()->name }}</span>
                <a
                  class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="{{asset('matrix/assets/images/users/1.jpg')}}"
                    alt="user"
                    class="rounded-circle"
                    width="31"
                  />
                </a>

                <ul
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown"
                >
                  <a class="dropdown-item" href="javascript:void(0)"
                    ><i class="mdi mdi-account me-1 ms-1"></i> My Profile</a
                  >

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{route('logout')}}"
                    ><i class="fa fa-power-off me-1 ms-1"></i> Logout</a
                  >
                  <div class="dropdown-divider"></div>

                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="{{route('dashboard.dashboard')}}"
                  aria-expanded="false"
                  ><i class="mdi mdi-view-dashboard"></i
                  ><span class="hide-menu">Dashboard</span></a
                >
              </li>
              <!-- //////////////////////// -->

              <!-- /////////////////////Forms///////////////////// -->

              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">Export Forms </span></a
                >

                <ul aria-expanded="false" class="collapse first-level">

                  @can('policy', [App\Models\User::class, 'exporter_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('export.exporter')}}" class="sidebar-link"
                      ><i class="mdi ">E</i
                      ><span class="hide-menu"> Exporter </span></a
                    >
                  </li>
                  @endcan

                  @can('policy', [App\Models\User::class, 'dest_country_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('DestCountry.DestCountry')}}" class="sidebar-link"
                      ><i class="mdi ">D C</i
                      ><span class="hide-menu"> Destination Country </span></a
                    >
                  </li>
                  @endcan

                  @can('policy', [App\Models\User::class, 'consignee_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('consignee.consignee')}}" class="sidebar-link"
                      ><i class="mdi ">C</i
                      ><span class="hide-menu"> Consignee </span></a
                    >
                  </li>
                  @endcan

                  @can('policy', [App\Models\User::class, 'transport_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('transport.transport')}}" class="sidebar-link"
                      ><i class="mdi ">T</i
                      ><span class="hide-menu"> Transport </span></a
                    >
                  </li>
                  @endcan

                  @can('policy', [App\Models\User::class, 'export_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('notify.index')}}" class="sidebar-link"
                      ><i class="mdi ">N</i
                      ><span class="hide-menu"> Notify </span></a
                    >
                  </li>
                 @endcan

                  @can('policy', [App\Models\User::class, 'tt_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('cmValue.index')}}" class="sidebar-link"
                      ><i class="mdi ">C M</i
                      ><span class="hide-menu"> Cm Value </span></a
                    >
                  </li>
                  @endcan

                  @can('policy', [App\Models\User::class, 'tt_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('ttInformation.ttInformation')}}" class="sidebar-link"
                      ><i class="mdi ">T I</i
                      ><span class="hide-menu"> TT Information </span></a
                    >
                  </li>
                  @endcan





                  {{-- //exportFormApparel.exportFormApparel --}}
                  @can('policy', [App\Models\User::class, 'export_manage'])
                  <li class="sidebar-item">
                    <a href="{{route('exportFormApparel.exportFormApparel')}}" class="sidebar-link"
                      ><i class="mdi ">E F</i
                      ><span class="hide-menu"> Export Form </span></a
                    >
                  </li>
                  @endcan


                </ul>
              </li>
            <!-- /////////////////////Forms///////////////////// -->

      <!-- shipping shipping.shipping//////////////////// -->
      @can('policy', [App\Models\User::class, 'shipping_manage'])

            <li class="sidebar-item">
              <a
                class="sidebar-link has-arrow waves-effect waves-dark"
                href="javascript:void(0)"
                aria-expanded="false"
                ><i class="fa-solid fa-ship"></i>
                <span class="hide-menu">Shipping </span></a
              >
              <ul aria-expanded="false" class="collapse first-level">

              <li class="sidebar-item">
                  <a href="{{route('shipping.shipping')}}" class="sidebar-link">
                    <i class="mdi">S</i>
                    <span class="hide-menu"> Shippings </span></a
                  >
                </li>

                {{-- <li class="sidebar-item">
                  <a href="{{route('shipping.addShippingDetails')}}" class="sidebar-link"
                    ><i class="mdi">S D</i
                    ><span class="hide-menu"> Add  Shipping Details </span></a
                  >
                </li> --}}
              </ul>
            </li>
            @endcan

              <!-- /////////////////////Invoice///////////////////// -->

              {{-- <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="{{route('invoice')}}"
                  aria-expanded="false"
                  ><i class="mdi mdi-chart-bar"></i
                  ><span class="hide-menu">Invoice</span></a
                >
              </li> --}}

              <!-- /////////////////////sales///////////////////// -->
              @can('policy', [App\Models\User::class, 'sales_manage'])
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="fa-solid fa-scale-unbalanced-flip"></i>
                  <span class="hide-menu">Sales </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                <li class="sidebar-item">
                    <a href="{{route('sales.index')}}" class="sidebar-link">
                      <i class="mdi">S</i>
                      <span class="hide-menu"> Sales </span></a
                    >
                  </li>


                </ul>
              </li>
              @endcan

              <!-- /////////////////////Audit/////////////////////  -->
              @can('policy', [App\Models\User::class, 'audit_manage'])
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="fa-solid fa-list-check"></i>
                  <span class="hide-menu">Audit </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                <li class="sidebar-item">
                    <a href="{{route('audit.indexAudit')}}" class="sidebar-link">
                      <i class="mdi">A D</i>
                      <span class="hide-menu"> Audit Details </span></a
                    >
                  </li>


                </ul>
              </li>
              @endcan

              <!-- /////////////////////billing.indexBilling///////////////////// audit.indexAudit -->
              @can('policy', [App\Models\User::class, 'billing_manage'])
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="fa-solid fa-money-bill-transfer"></i>
                  <span class="hide-menu">Billing </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                <li class="sidebar-item">
                    <a href="{{route('billing.indexBilling')}}" class="sidebar-link">
                      <i class="mdi">B D</i>
                      <span class="hide-menu"> Billing Details </span></a
                    >
                  </li>


                </ul>
              </li>
              @endcan

              <!-- /////////////////////Reports/////////////////////  -->
              <!-- /////////////////////billing.indexBilling///////////////////// audit.indexAudit -->
              {{-- @can('policy', [App\Models\User::class, 'billing_manage']) --}}
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="fa-solid fa-money-bill-transfer"></i>
                  <span class="hide-menu">Reports </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                {{-- <li class="sidebar-item">
                    <a href="{{route('reports.sales')}}" class="sidebar-link">
                      <i class="mdi">S R</i>
                      <span class="hide-menu"> Sales Reports</span></a
                    >
                  </li> --}}

                  <li class="sidebar-item">
                    <a href="{{route('reports.master')}}" class="sidebar-link">
                      <i class="mdi">M R</i>
                      <span class="hide-menu"> Master Report</span></a
                    >
                  </li>


                </ul>
              </li>
              {{-- @endcan --}}
              <!-- /////////////////////logistics.indexLogistics///////////////////// audit.indexAudit -->
              @can('policy', [App\Models\User::class, 'logistics_manage'])
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="fa-solid fa-cart-flatbed"></i>
                  <span class="hide-menu">logistics </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                <li class="sidebar-item">
                    <a href="{{route('logistics.indexLogistics')}}" class="sidebar-link">
                      <i class="mdi">L D</i>
                      <span class="hide-menu"> logistics Details </span></a
                    >
                  </li>


                </ul>
              </li>
              @endcan


               <!-- Employees//////////////////// -->
               @can('policy', [App\Models\User::class, 'emp_manage'])
               <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-account-multiple"></i
                  ><span class="hide-menu">Employees </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                <li class="sidebar-item">
                    <a href="{{route('employee.list')}}" class="sidebar-link">
                      <i class="mdi">L</i>
                      <span class="hide-menu"> List </span></a
                    >
                  </li>

                  <li class="sidebar-item">
                    <a href="{{route('employee.register')}}" class="sidebar-link"
                      ><i class="mdi">A N</i
                      ><span class="hide-menu"> Add  New </span></a
                    >
                  </li>


                </ul>
              </li>
            @endcan
      <!-- Employees//////////////////// -->

            <li class="sidebar-item">

              <a
                  class="sidebar-link"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-settings"></i>
                  <span class="hide-menu" style="font-size: smaller">Developed By <br>BD-IT: Abu Sufiun</span></a

                >
            </li>


            </ul>
          </li>




            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        @yield('content')
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!--boostrap 5 script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- ============================================================== -->
    <script src="{{asset('matrix/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('matrix/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('matrix/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('matrix/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('matrix/dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="{{asset('matrix/assets/libs/flot/excanvas.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('matrix/dist/js/pages/chart/chart-page-init.js')}}"></script>

    @yield('yajra_datatable_js')
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script> -->


    @yield('basic_table')

    @stack('scripts')
  </body>
</html>
