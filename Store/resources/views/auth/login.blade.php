@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, h3, p, label {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: rgba(13, 196, 209, 0.1);
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Custom styles for the container */
        .custom-container {
    max-width: 576px;
    padding: 111px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 60px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

        /* Custom styles for rows */
        .custom-row {
    display: flex;
    justify-content: center;
    align-items: center; /* Center vertically */
}


        /* Custom styles for the card */
        .custom-card {
            width: 100%;
        }

        /* Custom styles for the card header */
        .custom-card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Custom styles for form groups */
        .custom-form-group {
            margin-bottom: 15px;
        }

        /* Custom styles for labels */
        .custom-label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        /* Custom styles for inputs */
        .custom-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Custom styles for invalid feedback */
        .custom-invalid-feedback {
            color: #ff0000;
            font-size: 14px;
        }

        /* Custom styles for buttons */
        .custom-btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.3s ease; /* Add this line for animation */
}

.custom-btn:hover {
    background-color: #0056b3;
    transform: scale(1.1); /* Add this line for animation */
}

        /* Custom styles for links */
        .custom-btn-link {
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
            font-size: 14px;
            margin-left: 0; /* Adjust margin for the link */

        }

        .custom-btn-link:hover {
            text-decoration: underline;
        }

        /* Additional styles for form elements */
        .custom-form-group .form-check {
            margin-top: 10px;
        }

        .custom-form-group .form-check-label {
            margin-left: 5px;
        }
        body {
    font-size: 16px;
}

@media (max-width: 768px) {
    body {
        font-size: 14px;
    }
}

        
    </style>
</head>
<body>
    <div class="custom-container">
        <img src="{{asset('images/netcom.png') }}" alt="Logo" class="custom-logo"> <!-- Add your logo here -->

        <div class="custom-row">
            <div class="custom-card">
 
                <div class="custom-card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="custom-form-group">
                            <label for="email" class="custom-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="custom-invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="custom-form-group">
                            <label for="password" class="custom-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="custom-invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="custom-form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="custom-form-group">
                            <button type="submit" class="custom-btn">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="custom-btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
