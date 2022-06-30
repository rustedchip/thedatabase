<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 border-bottom border-secondary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('thedatabasetables') }}">The Database</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">

            {{-- LEFT LINKS --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 py-2">
                <li class="nav-item">
                    
                </li>
            </ul>

            {{-- RIGHT LINKS --}}
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 py-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <span class="dropdown-item-text fst-italic ">{{ Auth::user()->email }}</span>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

