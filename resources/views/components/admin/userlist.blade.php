<header class="text-gray-600 body-font bg-indigo-500">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
            <span class="ml-3 text-xl">掲示板</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center text-white">
            <a href="{{ route('admin.top.index') }}" class="mr-6">トップ画面</a>
            <a href="{{ route('logout') }}" class="backbtn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
        </nav>
    </div>
</header>