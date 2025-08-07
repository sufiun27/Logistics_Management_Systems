<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logistics Management System</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('matrix/assets/images/favicon.png')}}" />
    <link href="{{asset('matrix/dist/css/style.min.css')}}" rel="stylesheet" />

    <style>
        .auth-wrapper {
            /* Full-screen height */
            min-height: 100vh;
            /* Animated Pink Gradient Background */
            background: linear-gradient(-45deg, #ff5e78, #ff8c94, #ffb3c1, #ffccd5);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism Login Box */
        .auth-box {
            background: rgba(255, 255, 255, 0.15); /* Slightly more opaque for pink theme */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px); /* For Safari */
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            padding: 2rem;
            width: 100%;
            max-width: 400px; /* Constrain width for better appearance */
        }

        /* Brand Logo Styling */
        .brand-logo .logo-text {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }
        .brand-logo .tagline {
            font-size: 1rem;
            color: #f8d7da;
            letter-spacing: 1px;
        }

        /* Modernized Input Fields */
        .custom-input-group .form-control-lg {
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid transparent;
            color: #fff;
            border-radius: 0.5rem !important;
        }
        .custom-input-group .form-control-lg:focus {
            background: rgba(0, 0, 0, 0.35);
            border-color: rgba(255, 105, 135, 0.5);
            box-shadow: none;
            color: #fff;
        }
        .custom-input-group .form-control-lg::placeholder {
            color: #d1d1d1;
        }
        .custom-input-group .input-group-text {
            background: transparent;
            border: none;
            color: #f8f5f5; /* Pink accent color */
        }

        /* Pink Gradient Login Button */
        .login-btn {
            background-image: linear-gradient(to right, #ff5e78 0%, #ff99ac 51%, #ff5e78 100%);
            transition: 0.5s;
            background-size: 200% auto;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 0 20px rgba(255, 158, 172, 0.4);
            border: none;
            border-radius: 0.5rem;
        }
        .login-btn:hover {
            background-position: right center;
            color: #fff;
        }
        
        /* Alert Styling */
        .alert-danger {
            background-color: rgba(255, 105, 135, 0.8);
            border: none;
            color: white;
        }

        /* Ensure main-wrapper takes full height */
        .main-wrapper {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box p-4">
                <div id="loginform">
                    <div class="text-center pt-3 pb-3 brand-logo">
                        <span class="db">
                           <div class="logo-text">Hop Lun</div>
                           <h3>Logistics Management System</h3>
                           <p class="tagline">Secure Login Portal</p>
                        </span>
                    </div>

                    @if($errors->any())
                      <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                              <span>{{ $error }}</span>
                          @endforeach
                      </div>
                    @endif
                    @if(session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                    @endif

                    <form class="form-horizontal mt-3" id="loginform" method="post" action="{{route('login.authorization')}}">
                        @csrf
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3 custom-input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-email fs-4"></i>
                                    </span>
                                    <input name="email" type="email" class="form-control form-control-lg" placeholder="Email Address" required />
                                </div>
                                <div class="input-group mb-3 custom-input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-lock fs-4"></i>
                                    </span>
                                    <input name="password" type="password" class="form-control form-control-lg" placeholder="Password" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-lg login-btn text-white" type="submit">
                                        LOG IN
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('matrix/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</body>

</html>