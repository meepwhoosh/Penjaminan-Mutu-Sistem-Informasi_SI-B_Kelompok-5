<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Adopt a Buddy</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        /* Left Side - Blue Background with Dog */
        .left-side {
            flex: 1;
            background-color: #4A5FC1;
            position: relative;
            display: flex;
            align-items: flex-end;
            
            overflow: hidden;
        }

        .paw-prints {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
        }

        .paw-print {
            width: 80px;
        }

        .dog-image {
            width: 70%;
            object-fit: contain;
            margin-bottom: 0;
        }

        /* Right Side - Yellow Background with Form */
        .right-side {
            flex: 1;
            background-color: #FDB93A;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .logo-container {
            background-color: white;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .register-title {
            color: #4A5FC1;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .form-container {
            width: 1000%;
            max-width: 500px;
        }

        .input-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
            flex: 1;
        }

        .input-wrapper {
            background-color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            gap: 15px;
        }

        .input-icon {
            width: 20px;
            height: 20px;
            color: #6B7280;
        }

        .form-input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 16px;
            color: #1F2937;
            font-family: 'Poppins', sans-serif;
        }

        .form-input::placeholder {
            color: #9CA3AF;
        }

        .toggle-password {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            color: #6B7280;
        }

        .terms-text {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
            color: #4A5FC1;
        }

        .terms-text a {
            color: #4A5FC1;
            text-decoration: underline;
            font-weight: 600;
        }

        .signup-button {
            width: 100%;
            background-color: #4A5FC1;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 20px;
        }

        .signup-button:hover {
            background-color: #3d4fa3;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #4A5FC1;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-button {
            flex: 1;
            background-color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .social-button:hover {
            transform: translateY(-2px);
        }

        .social-button img {
            width: 24px;
            height: 24px;
        }

        .signin-link {
            text-align: center;
            color: #4A5FC1;
            font-size: 14px;
        }

        .signin-link a {
            color: #4A5FC1;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        .signin-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-side {
                flex: 0.4;
            }

            .right-side {
                flex: 0.6;
                padding: 20px;
            }

            .dog-image {
                max-height: 100%;
            }

            .input-row {
                flex-direction: column;
                gap: 0;
            }

            .form-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="paw-prints">
                <img src="{{ asset('images/paw.png') }}" alt="Cat" class="paw-print">
            </div>
                <img src="{{ asset('images/SignUp.png') }}" alt="Paw Print" class="dog-image">
            
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <div class="logo-container">
                <img src="{{ asset('images/Logo.png') }}" alt="Adopt a Buddy Logo" class="logo">
            </div>

            <h1 class="register-title">Register</h1>

            <div class="form-container">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="input-row">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="text" name="first_name" class="form-input" placeholder="First Name" required value="{{ old('first_name') }}">
                            </div>
                            @error('first_name')
                                <span style="color: #4A5FC1; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="text" name="last_name" class="form-input" placeholder="Last Name" required value="{{ old('last_name') }}">
                            </div>
                            @error('last_name')
                                <span style="color: #4A5FC1; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input type="email" name="email" class="form-input" placeholder="Email" required value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span style="color: #4A5FC1; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <svg id="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span style="color: #4A5FC1; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="terms-text">
                        By proceeding you agree to our <a href="{{ route('terms') }}">Terms of Use</a> and acknowledge our <a href="{{ route('privacy') }}">Privacy Policy</a>.
                    </div>

                    <button type="submit" class="signup-button">Sign Up</button>
                </form>

                <div class="divider">Or sign up with</div>

                <div class="social-login">
                    <button type="button" class="social-button" onclick="window.location.href='{{ route('register.google') }}'">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </button>
                    <button type="button" class="social-button" onclick="window.location.href='{{ route('register.facebook') }}'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#1877F2">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button type="button" class="social-button" onclick="window.location.href='{{ route('register.apple') }}'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#000000">
                            <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                        </svg>
                    </button>
                </div>

                <div class="signin-link">
                    Already have an account?<a href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }
    </script>
</body>
</html>