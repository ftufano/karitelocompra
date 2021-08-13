<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@lang('webtags.company_name') | @lang('Register')</title>

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
    <link href="css/intl-tel-input/intlTelInput.min.css" rel="stylesheet" >

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
                                        <h1 class="h4 text-gray-900 cm-h4-text mb-4">@lang('Register')</h1>
                                    </div>
                                    @if(Session::has('errorReg'))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ Session::get('errorReg') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <form class="user" id="regUserForm" action="{{ route('regUser') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputName">@lang('First Name and Last Name')</label>
                                            <input type="text" class="form-control form-control-user" id="inputName" name="name"
                                            placeholder="@lang('First Name and Last Name')"
                                                
                                            @if(Session::has('errorReg'))
                                                value="{{ Session::get('currentName') }}"
                                            @endif
                                            
                                             required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail">@lang('E-Mail Address')</label>
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="@lang('E-Mail Address')"
                                                
                                                @if(Session::has('errorReg'))
                                                    value="{{ Session::get('currentEmail') }}"
                                                @endif
                                                
                                                required>
                                        </div>
                                        <div class="form-group cm-dsp-grd">
                                            <label for="inputPhone">@lang('Mobile Phone Number')</label>
                                            <input type="tel" name="phone" class="form-control form-control-user"
                                                id="inputPhone"
                                                
                                                @if(Session::has('errorReg'))
                                                    value="{{ Session::get('currentPhone') }}"
                                                @endif
                                                
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword">@lang('Password')</label>
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="inputPassword" placeholder="@lang('Password')"
                                                
                                                @if(Session::has('errorReg'))
                                                    value="{{ Session::get('currentPassword') }}"
                                                @endif

                                                 required>
                                        </div>
                                        <div class="form-group">
                                        <label for="inputConfirmPassword">@lang('Confirm Password')</label>
                                                <input type="password" class="form-control form-control-user"
                                                    id="inputConfirmPassword" name="repeat_password" placeholder="@lang('Confirm Password')" required>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="inputType">@lang('User Type')</label>
                                            <select class="form-control form-control-user" id="inputType" name="type">
                                                <option>@lang('Administrator')</option>
                                                <option selected>@lang('Customer')</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    @lang('Register')
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
                                        <a class="small" href="{{ url('/')}}">@lang('Already have an account?, Login')</a>
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
    <script src="js/cm_karitelocompra_js.js"></script>
    <script src="js/intl-tel-input/intlTelInput.min.js"></script>

    <script>
        var input = document.querySelector("#inputPhone");
        var iti = window.intlTelInput(input, {
            utilsScript:"js/intl-tel-input/utils.js",
          // any initialisation options go here
          placeholderNumberType:'MOBILE', //set placeholder phone example on phone input
          preferredCountries:['ve', 'ar'], //put on list top the countries declared in this array
        });

        $('#inputPhone').keydown(function (e) { //Function to check which keys are allowed on the input
            var key = e.charCode || e.keyCode || 0; //Getting the keyboard event numbers or codes
            $text = $(this); //Getting the input field value on a variable
            
            $text.val($text.val().replace(/[^0-9]/g, "")); //Setting the $text value by replacing any character but numbers using a RegEx

            //Returning only allowed keys (backspace, tab, supress, normal number keys, numpad keys, arrows)
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || (key >= 37 && key <= 40));
        })

        input.addEventListener('input', function() {
            input.value = input.value.replace(/[^0-9]/g, ""); //Setting the $text value by replacing any character but numbers using a RegEx

            if(!iti.isValidNumber()){
                input.setCustomValidity('El número indicado no es válido en ' + iti.getSelectedCountryData().name);
            }else{
                input.setCustomValidity('');
            }
            
        });

        input.addEventListener('blur', function() {

            var number = iti.getNumber();
            
            if (number.indexOf("+") == -1){

                if(number.length != 0){
                    number = "+"+number;
                }
            }
            
            iti.setNumber(number);
            var valNumber = input.value;

            if(!iti.isValidNumber()){

            input.setCustomValidity('El número indicado no es válido en ' + iti.getSelectedCountryData().name);

            }else{

                input2.setCustomValidity('');
                var number2 = iti2.getNumber();
                iti2.setNumber(number2);

            }
        });

        document.getElementById('regUserForm').onsubmit = function() {
            var number = iti.getNumber();

            iti.setNumber(number);
            input.value = iti.getNumber(); //join the international prefix with the typed phone number
        };
    </script>

</body>

</html>