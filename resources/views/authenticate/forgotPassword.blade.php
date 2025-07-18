<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoTripJava</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ url('assets/css/login.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @include('components.css-pop-up')
</head>

<body>
    <div class="wrapper">
        <h2>Forget <br>Password</h2>
        <p id="pFroget">Enter the email address <br> and we’ll send you a link to reset password</p>
        <form id="forgot" action="{{ url('check-email') }}" method="POST">
            @csrf
            <input class="input" type="email" placeholder="Email" id="email" name="email"  value="{{ old('email') }}" required>
            <button id="buttonLogin" type="submit">Submit</button>
        </form>
        <div class="member">
            <br>
            Cancel Reset Password? <a href="{{ url('login') }}">Login Here</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')
    <script>
            $(document).ready(function() {
                $('#forgot').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        email: {
                            required: "<strong>email wajib diisi.</strong>",
                            email: "<strong>email harus berupa alamat surel yang valid.</strong>"
                        }
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
