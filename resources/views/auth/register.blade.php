<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/app.css'])
<title>新規登録</title>
</head>
<body>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">新規登録</h1>
                </div>
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <form action="{{ route('auth.store') }}" method="POST" >
                    @csrf
                        <div class="flex flex-wrap -m-2">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="username" class="leading-7 text-sm text-gray-600">名前</label>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <p style="color:red">{{ $message }}</p>
                                        </span>
                                    @enderror
                                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full mt-5">
                                <div class="relative">
                                    <label for="email" class="leading-7 text-sm text-gray-600">フリガナ</label>
                                    @error('phonetic')
                                        <span class="invalid-feedback" role="alert">
                                            <p style="color:red">{{ $message }}</p>
                                        </span>
                                    @enderror
                                    <input type="text" id="phonetic" name="phonetic" :value="old('phonetic')" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full mt-5">
                                <div class="relative">
                                    <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <p style="color:red">{{ $message }}</p>
                                        </span>
                                    @enderror
                                    <input type="email" id="email" name="email" :value="old('email')" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full mt-5">
                                <div class="relative">
                                    <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <p style="color:red">{{ $message }}</p>
                                        </span>
                                    @enderror
                                    <input type="password" id="password" name="password" :value="old('password')" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <button class="flex mx-auto mt-7 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                            </div>
                            <div class="p-2 w-full">
                                <a href="{{ route('login') }}" class="block text-center text-lg mx-auto mt-7">ログイン画面へ戻る</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>