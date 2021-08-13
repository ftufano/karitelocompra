<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@lang('webtags.company_name')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="img/karitelocompra_logo_mini.png"/>

    {{-- Custom fonts for this template--}}
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/my-butterfly" rel="stylesheet">

    {{-- Custom styles for this template--}}
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/cm_karitelocompra_css.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        {{-- Outer Row --}}
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-7 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        {{-- Nested Row within Card Body --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <a href="">
                                            <img src="img/karitelocompra_login_logo.png" class="cm-img-h-w">
                                        </a>
                                        <h1 class="h4 text-gray-900 cm-h4-text mb-4">@lang('Welcome!')</h1>
                                    </div>
                                    @if(Session::has('wrongCredentials'))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ Session::get('wrongCredentials') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @elseif (Session::has('lnkXprd'))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ Session::get('lnkXprd') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @elseif (Session::has('successReg'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        {{ Session::get('successReg') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @elseif (Session::has('successFgtPwd'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        {{ Session::get('successFgtPwd') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @elseif (Session::has('successPwdRst'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        {{ Session::get('successPwdRst') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <form class="user" action="{{ route('userLogin') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail">@lang('E-Mail Address')</label>
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="@lang('E-Mail Address')"
                                                
                                                @if(Session::has('wrongCredentials'))
                                                    value="{{ Session::get('currentEmail') }}"
                                                @endif
                                                
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword">@lang('Password')</label>
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="@lang('Password')"
                                                
                                                @if(Session::has('wrongCredentials'))
                                                    value="{{ Session::get('currentPassword') }}"
                                                @endif

                                                 required>
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                <label class="custom-control-label" for="customCheck">@lang('Remember Me')</label>
                                            </div>
                                        </div> --}}
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    @lang('Login')
                                                </button>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <a href="{{ url('/')}}" type="submit" class="btn btn-outline-secondary btn-user btn-block">
                                                    @lang('Cancel')
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{url('forgot-password')}}">@lang('Forgot Your Password?')</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{url('register')}}">@lang('You don’t have an account?, Sign Up')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <footer class="sticky-footer">
            <div class="container my-auto">
              <div class="copyright text-center text-light my-auto">
                <span>@lang('All rights reserved.') &copy; @lang('webtags.company2_name') 2021 | 
                    @lang('Web Site Developed By:') <a href="https://caelumdev.com" class="cm-a-clr" target="_blank"> @lang('webtags.caelumdev')</a></span>
              </div>
            </div>
          </footer>

    </div>

    {{-- Bootstrap core JavaScript--}}
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    {{-- Core plugin JavaScript--}}
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    {{-- Custom scripts for all pages--}}
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>