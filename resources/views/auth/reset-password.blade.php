<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Reset Password | Brassica Pay</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/fontawesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Custom Login Styles -->
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        <img src="{{ asset('assets/images/brassica.png') }}" alt="Brassica Pay" width="180">
            <p class="text-center m-t-md">
               <strong>Forgot Password.</strong>
            </p>
        @include('components.alerts')
        <form method="post" action="{{ route('password.email') }}">
            @csrf
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <button type="submit" class="btn btn-login btn-block">
                <i class="fa fa-sign-in"></i> Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="forgot-link">Login</a>

        <hr style="opacity: 0.25">
        <p class="footer-text"><a><?php echo date('Y') ?> &copy; TGL Systems</a>.</p>



    </div>
</div>

<script src="{{ asset('assets/plugins/jquery/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
