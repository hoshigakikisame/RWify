<div class="nav-container px-10 lg:px-20 py-5">
    <nav class="flex justify-between ">
        <div class="navbar-brand flex dark:text-gray-200">
            <img src="" alt="logo">
            <h1 class="text-2xl ">RWify</h1>
        </div>
        <div class="navbar-body">
            <ul class="link-container dark:text-gray-400 flex gap-2">
                <li class="link-item px-2 py-1">Beranda</li>
                <li class="link-item px-2 py-1">Layanan</li>
                <li class="link-item px-2 py-1">Informasi</li>
                <li class="link-item px-2 py-1">Hubungi Kami</li>
            </ul>
        </div>
        <div class="navbar-action">
            <a class="login-button dark:text-gray-200 dark:bg-green-900 px-4 py-2 border border-gray-200 border-opacity-10 rounded-lg " href="{{route('auth.signIn')}}">Sign In</a>
        </div>
    </nav>
</div>