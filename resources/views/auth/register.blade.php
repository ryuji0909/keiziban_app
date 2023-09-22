<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/register.css'])
<title>Lesson Sample Site</title>
</head>
<body>
    <div class="container">
            <form action="{{ route('auth.store') }}" method="POST" >
            @csrf
                <div class="content">
                    <h2>新規登録画面</h2>
                    <!-- Name -->
                    <dl>
                        <dt class="username">
                            <label for="username">名前:</label>
                            <span class="hissu">必須</span>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                        </dt>
                        <dd>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" />
                        </dd>

                        <!-- Furigana -->
                        <dt class="phonetic">
                            <label for="phonetic">フリガナ:</label>
                            <span class="hissu">必須</span>
                            @error('phonetic')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                        </dt>
                        <dd>
                            <input id="phonetic" type="text" name="phonetic" :value="old('phonetic')" />
                        </dd>

                        <!-- Password -->
                        <dt class="password">
                            <label for="password">パスワード:</label>
                            <span class="hissu">必須</span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                        </dt>
                        <dd>
                            <input id="password" type="password" name="password" :value="old('password')" />
                        </dd>

                        <!-- Confirm Password -->
                        <dt class="password_confirmation">
                            <label for="password_confirmation">パスワード確認:</label>
                            <span class="hissu">必須</span>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                        </dt>
                        <dd>
                            <input id="password_confirmation" type="password" name="password_confirmation" :value="old('password_confirmation')" />
                        </dd>

                        <!-- Email Address -->
                        <dt class="email">
                            <label for="email">メールアドレス:</label>
                            <span class="hissu">必須</span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                        </dt>
                        <dd>
                            <input id="email" type="text" name="email" :value="old('email')" />
                        </dd>

                        <!--　送信ボタン-->
                        <div class="btn">
                            <button type="submit" class="button">送信</button>
                        </div>
                        <!-- 戻るボタン -->
                        <div class="btn">
                            <a href="{{ route('login') }}" class="button">戻る</a>
                        </div>
                    </dl>
                </div>
            </form>
        </div>
    </body>
</html>