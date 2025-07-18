<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoTripJava</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />

    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}" />

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}" />

    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/themify-icons.css') }}" />

    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/flaticon.css') }}" />

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.min.css') }}" />

    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/gijgo.min.css') }}" />

    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/nice-select.css') }}" />

    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/slick.css') }}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/login.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    @include('components.css-pop-up')
</head>

<body>
    <div class="wrapper">
        <div class="back">
            <a href="{{ url('/') }}"><button class="btn_back"><i class="fas fa-home"></i> Home</button></a>
        </div>
        <h2>Login ke <br>Pesona Desa</h2>
        <form id="login" action="{{ url('proses-login') }}" method="POST">
            @csrf
            <input class="input" type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
            <input class="input" type="password" placeholder="Password" id="password" name="password">
            <div class="recover">
                <a href="{{ url('forgot-password') }}">Lupa Password?</a>
            </div>
            <button type="submit" id="buttonLogin">Log In</button>
        </form>
        <p><b>ATAU</b></p>
        <form action="{{ url('auth/google') }}">
            @csrf
            <button id="buttonGoogle"><img src="{{ url('assets/img/icongg.png') }}" alt="text">
                <span>Sign In with Google</span>
            </button>
        </form>
        <div class="member">
            <br>
            Belum menjadi member? <a href="{{ url('register') }}">Register disini</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')
    <script>
            $(document).ready(function() {
                $('#login').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },
                    },
                    messages: {
                        email: {
                            required: "<strong>email wajib diisi.</strong>",
                            email: "<strong>email harus berupa alamat surel yang valid.</strong>"
                        },
                        password: {
                            required: "<strong>password wajib diisi.</strong>",
                            minlength: "<strong>password minimal berisi 6 karakter.</strong>"
                        },
                    },
                    errorClass: "invalid-feedback text-left mb-3 ml-4",
                    errorElement: "div",
                    highlight: function(element) {
                        $(element).addClass('is-invalid mb-0');
                    },
                    unhighlight: function(element) {
                        $(element).removeClass('is-invalid mb-0');
                    },
                });
            });
    </script>
</body>

</html>
