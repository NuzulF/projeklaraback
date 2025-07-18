<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoTripJava</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ url('assets/css/login.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @include('components.css-pop-up')
</head>

<body>
    <div class="wrapper">
        <h2>Forget <br>Password</h2>
        <p id="pFroget">Enter your new password</p>
        <form id="reset" action="{{ url('proses-reset-password', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="password" placeholder="Password" id="password" name="password" required>
            <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required>
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

                $.validator.addMethod("regex", function(value, element) {
                    return this.optional(element) || /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(value);
                }, "password harus sesuai regex");

                $('#reset').validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 6,
                            regex: true
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 6,
                            regex: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        password: {
                            required: "<strong>password wajib diisi.</strong>",
                            minlength: "<strong>password minimal berisi 6 karakter.</strong>",
                            regex: "<strong>password wajib menggunakan karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).</strong>"
                        },
                        password_confirmation: {
                            required: "<strong>password wajib diisi.</strong>",
                            minlength: "<strong>password minimal berisi 6 karakter.</strong>",
                            regex: "<strong>password wajib menggunakan karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).</strong>",
                            equalTo: "<strong>konfirmasi password tidak cocok.</strong>"
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
