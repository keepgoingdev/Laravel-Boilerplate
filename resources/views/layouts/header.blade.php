<header>
    <div class="top-bar">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">
                    <img src="/images/EIRS-logo.png">
                    <img src="/images/Logo.png">
                </a>
            </div>
            <ul>
            @guest
            @else
                <li>
                    <a href="#" role="button">
                        {{ Auth::user()->email }} <span class="caret"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
            </ul>
        </div>
    </div>
    <div class="navbar navbar-default">
        <div class="container">
            <div class="navbar-collapse collapse" id="navMainMenu" aria-expanded="false">

            </div>
        </div>
    </div>
</header>