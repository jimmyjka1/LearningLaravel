<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Crud Example</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                        Users
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.index') }}">All Users</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.create') }}">Create New User</a></li>
                        @if (session('user_id'))
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('user.login_page') }}">Login</a></li>
                        @endif
                    </ul>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                        Post
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="{{ route('post.index') }}">All Posts</a></li>
                        <li><a class="dropdown-item" href="{{ route('post.create') }}">Create Posts</a></li>
                        {{-- <li><a class="dropdown-item" href="#">My Posts</a></li> --}}
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</nav>
