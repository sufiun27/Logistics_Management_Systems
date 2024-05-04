@extends('template.index')
@section('content')

    <!-- Custom CSS -->
    {{-- <link
      href="../assets/libs/jquery-steps/jquery.steps.css"
      rel="stylesheet"
    /> --}}
    <link href="{{asset('matrix/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet" />
    <link hre{{asset('matrix/matrix/dist/css/style.min.css')}}" rel="stylesheet" />

          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="card">
            <div class="card-body wizard-content">
              <h4 class="card-title">Basic Form Example</h4>
              <h6 class="card-subtitle"></h6>
              <form id="example-form" action="#" class="mt-5">
                <div>
                  <h3>Account</h3>
                  <section>
                    <label for="userName">User name *</label>
                    <input
                      id="userName"
                      name="userName"
                      type="text"
                      class="required form-control"
                    />
                    <label for="password">Password *</label>
                    <input
                      id="password"
                      name="password"
                      type="text"
                      class="required form-control"
                    />
                    <label for="confirm">Confirm Password *</label>
                    <input
                      id="confirm"
                      name="confirm"
                      type="text"
                      class="required form-control"
                    />
                    <p>(*) Mandatory</p>
                  </section>
                  <h3>Profile</h3>
                  <section>
                    <label for="name">First name *</label>
                    <input
                      id="name"
                      name="name"
                      type="text"
                      class="required form-control"
                    />
                    <label for="surname">Last name *</label>
                    <input
                      id="surname"
                      name="surname"
                      type="text"
                      class="required form-control"
                    />
                    <label for="email">Email *</label>
                    <input
                      id="email"
                      name="email"
                      type="text"
                      class="required email form-control"
                    />
                    <label for="address">Address</label>
                    <input
                      id="address"
                      name="address"
                      type="text"
                      class="form-control"
                    />
                    <p>(*) Mandatory</p>
                  </section>
                  <h3>Hints</h3>
                  <section>
                    <ul>
                      <li>Foo</li>
                      <li>Bar</li>
                      <li>Foobar</li>
                    </ul>
                  </section>
                  <h3>Finish</h3>
                  <section>
                    <input
                      id="acceptTerms"
                      name="acceptTerms"
                      type="checkbox"
                      class="required"
                    />
                    <label for="acceptTerms"
                      >I agree with the Terms and Conditions.</label
                    >
                  </section>
                </div>
              </form>
            </div>
          </div>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('matrix/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('matrix/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('matrix/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('matrix/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('matrix/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('matrix/dist/js/custom.min.js')}}"></script>
    <!-- this page js -->
    <script src="{{asset('matrix/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script>
      // Basic Example with form
      var form = $("#example-form");
      form.validate({
        errorPlacement: function errorPlacement(error, element) {
          element.before(error);
        },
        rules: {
          confirm: {
            equalTo: "#password",
          },
        },
      });
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
        },
        onFinishing: function (event, currentIndex) {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
        },
        onFinished: function (event, currentIndex) {
          alert("Submitted!");
        },
      });
    </script>
  

@endsection