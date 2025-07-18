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

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/login.css') }}">
    @include('components.css-pop-up')
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="back">
            <a href="{{ url('/') }}"><button class="btn_back"><i class="fas fa-home"></i> Home</button></a>
        </div>
        <h2>Login as <br>Admin</h2>
        <form id="login" action="{{ url('proses-login-admin') }}" method="POST">
            @csrf
            <input class="input @error('email') is-invalid mb-0 @enderror" type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback text-left mb-3 ml-1">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            <input class="input @error('password') is-invalid mb-0 @enderror" type="password" placeholder="Password" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback text-left mb-3 ml-1">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            <button type="submit" id="buttonLogin">Log In</button>
        </form>
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
