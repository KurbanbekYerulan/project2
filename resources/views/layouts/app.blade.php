<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/toastr.js') }}" defer></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            @if(Session::has('loggedin'))
                <script>
                    toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true
                        }
                    toastr.success("{{ session('loggedin') }}");
                </script>
            @endif

            @if(Auth::user())
                <div class="col-lg-4">
                    <ul class="list-group">

                        <li class="list-group-item">
                            <a href="{{route('users.profile')}}">Edit a profile</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('categories')}}">Categories</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('categories.create')}}">Create a new Category</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('posts')}}">Posts</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('post.trashed')}}">Trashed posts</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('post.create')}}">Create a new Post</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('tags')}}">Tags</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('tag.create')}}">Create a new Tag</a>
                        </li>
                        @if(Auth::user()->admin)
                            <li class="list-group-item">
                                <a href="{{route('users')}}">Users</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('user.create')}}">Create a new user</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('settings')}}">Settings</a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            <div class="col-lg-8">
                @yield('content')
            </div>

        </div>
    </div>
</div>
<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('success') }}");
    @endif
        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif
</script>

    @yield('scripts')
</body>

</html>
