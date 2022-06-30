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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image: url({{asset('images/background.jpeg')}}); flex-wrap: wrap;">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/images/logo.jpeg') }}" class="logo"/>
            </a>
            <a class="navbar-brand" href="{{route('product.index')}}">
                All Products
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->


                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Filters
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <form method="GET" action="{{route('filtered.products')}}">
                                @csrf
                                <select name="category_id" class="form-control">
                                    <option value="" selected disabled> Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>

                                <select name="cloth_id" class="form-control">
                                    <option value="" selected disabled> Select Cloth</option>
                                    @foreach($clothes as $cloth)
                                        <option value="{{$cloth->id}}">{{$cloth->name}}</option>
                                    @endforeach
                                </select>

                                <select name="size_id" class="form-control">
                                    <option value="" selected disabled> Select size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                    @endforeach
                                </select>

                                <select name="color_id" class="form-control">
                                    <option value="" selected disabled> Select color</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}">{{$color->name}}</option>
                                    @endforeach
                                </select>

                                <input type="submit" class="btn btn-secondary" value="Filter">
                            </form>
                        </div>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->

                    <form action="{{route('search.all')}}" method="GET">
                        @csrf
                        <input type="text" name="search" placeholder="search">
                        <input type="submit" value="submit" name="submit" placeholder="submit">
                    </form>
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('product.create')}}">Publish</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('product.userFavouritesProducts')}}">Favourites</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('messages.index')}}">
                                {{ __('Messages') }}{{__($notRead)}}
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{route('user.index')}}">
                                    {{ __('Settings') }}
                                </a>
                                @if(Auth::user()->role_id == 2)
                                    <a class="dropdown-item" href="{{route('admin.index')}}">
                                        {{ __('Admin') }}
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{route('products.myProducts')}}">
                                    {{ __('My Products') }}
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
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>

<footer>

</footer>
