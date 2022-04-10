<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TODOAPP - Giriş Yap</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('default/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('default/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('default/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('default/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition dark-mode login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>TODO</b>APP</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Giriş yapın lütfen</p>

                <form id="giris_form" onsubmit="return false;">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Beni Hatırla
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="giris_yap">Giriş Yap</button>
                    </div>
                <!-- /.col -->
                </div>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<!-- /.login-box -->

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
            $('#giris_form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {

                    email: {
                        required: "Bu alanı doldurmak zorunludur",
                        email: "Lütfen geçerli bir e-mail adresi giriniz."
                    },

                    password: {
                        required: "Bu alanı doldurmak zorunludur",
                        minlength: "Gireceğiniz şifre en az 5 karakterden oluşmalıdır"
                    }
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

            $('#giris_yap').on('click', function() {
                // $('#register_form').valid();
                if($('#giris_form').valid()) {
                    var formData = new FormData($('#giris_form')[0]);
                    $.ajax({
                        method : "POST",
                        url : "{{ route('login.index')}} ",
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
        });
    </script>
</body>
</html>
