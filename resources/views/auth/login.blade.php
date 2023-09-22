<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/login.css'])
<title>Lesson Sample Site</title>
</head>
<body>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="container">
            <h2>Login</h2>

            <!-- Email Address -->
            <div class="email">
                <x-input-error :messages="$errors->get('email')" class="error" style="color: red"/>  
                <input id="email" type="email" name="email"  placeholder="emailaddress"> 
            </div>

            <!-- Password -->
            <div class="password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red"/>
                <input id="password" type="password" name="password" placeholder="password">
            </div>

            <div class="btn">
                <button type="submit" class="btn">Login</button>
            </div>
            <div class="btn">
                <a href="{{ route('auth.register') }}">Sign Up</a>
            </div>
        </div>
    </form>
</body>
</html>