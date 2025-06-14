<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Laravel 商城</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">購物車</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ Auth::user()->email }}</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">@csrf
                            <button class="btn btn-link nav-link">登出</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">註冊</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
