<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Kayıt Ol</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('default/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('default/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('default/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('default/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition register-page dark-mode">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{route('index')}}" class="h1"><b>TODO</b>APP</a>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Kayıt olmak ücretsizdir.</p>            
            <form method="post" id="register_form" onsubmit="return false;">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Kullanıcı adı" name="username" id="username" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Şifreniz" name="password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Şifrenizi tekrar giriniz" name="re_password" id="re_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="input-group icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="kaydol">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Google+ İle Giriş Yap
                </a>
            </div>

            <a href="{{route("index")}}" class="text-center">Ben zaten kayıtlıyım</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{asset('default/plugins/jquery/jquery.min.js')}} "></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('default/plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <script src="{{asset('default/plugins/jquery-validation/jquery.validate.min.js')}} "></script>
    <!-- AdminLTE App -->
    <script src="{{asset('default/js/adminlte.min.js')}} "></script>
    <!-- Toastr -->
    <script src="{{asset('default/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#register_form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    re_password: {
                        required: true,
                        minlength: 5
                    },
                    username : {
                        required : true
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    username : {
                        required: "Bu alanı doldurmak zorunludur"
                    },
                    email: {
                        required: "Bu alanı doldurmak zorunludur",
                        email: "Lütfen geçerli bir e-mail adresi giriniz."
                    },
                    password: {
                        required: "Bu alanı doldurmak zorunludur",
                        minlength: "Gireceğiniz şifre en az 5 karakterden oluşmalıdır"
                    },
                    re_password: {
                        required: "Bu alanı doldurmak zorunludur",
                        minlength: "Gireceğiniz şifre en az 5 karakterden oluşmalıdır"
                    },
                    terms: "Lütfen kayıt şartlarını kabul ediniz."
                },
                errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#kaydol').on('click', function() {
                // $('#register_form').valid();
                
                if($('#register_form').valid()) {
                    var formData = new FormData($('#register_form')[0]);
                    $.ajax({
                        method : "POST",
                        url : "{{ route('register.create')}} ",
                        data : formData,
                        dataType : "json",
                        processData : false,
                        contentType : false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            // console.log(res);
                            if(res.status) {
                                toastr.success(res.message);
                                setTimeout(() => {
                                    window.location.href = '{{route("index")}}';
                                }, 2000);
                            } else {
                                toastr.warning(res.message)
                            }
                        },
                        error: function() {

                        }
                    })
                } else {
                    console.log("Deneme");
                }
            })

            function fireToast(title, body) {
               
            }
        });


       
    </script>
</body>
</html>
