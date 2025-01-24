<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
    <link rel="stylesheet" href="{{ asset('styles.css') }}"> <!-- Menghubungkan file CSS dengan asset() -->
    <style>
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #fff; /* Warna teks tautan */
        }

        .login-link a {
            color: #fff; /* Warna tautan */
            text-decoration: underline; /* Garis bawah pada tautan */
            transition: color 0.2s; /* Transisi warna saat hover */
        }

        .login-link a:hover {
            color: #D1D1D4; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form action="{{ url('register') }}" method="POST" class="login">
                    @csrf
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" name="name" class="login__input" placeholder="Name" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="password" class="login__input" placeholder="Password" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="password_confirmation" class="login__input" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="login__submit">Register</button>
                    @if ($errors->any())
                        <div style="color: red;">{{ $errors->first() }}</div>
                    @endif
                </form>
                <div class="social-login">
                    <div class="social-icons">
                        <a href="#" class="social-login__icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-login__icon"><i class="fab fa-google"></i></a>
                    </div>
                </div>
                <div class="login-link">
                    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape1"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape4"></span>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Font Awesome untuk ikon -->
</body>
</html>
