<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @can('admin-or-librarian', App\Models\User::class)
                            <li class="nav-item dropdown">
                                <a id="booksDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Livros
                                </a>
                                <div class="dropdown-menu" aria-labelledby="booksDropdown">
                                    <a class="dropdown-item no-border text-dark" href="{{ route('books.index') }}">Listar Livros</a>
                                    <a class="dropdown-item no-border text-dark" href="{{ route('books.create') }}">Adicionar Livro</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="authorsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Autores
                                </a>
                                <div class="dropdown-menu" aria-labelledby="authorsDropdown">
                                    <a class="dropdown-item no-border text-dark" href="{{ route('authors.index') }}">Listar Autores</a>
                                    <a class="dropdown-item no-border text-dark" href="{{ route('authors.create') }}">Adicionar Autor</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="categoriesDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Categorias
                                </a>
                                <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                                    <a class="dropdown-item no-border text-dark" href="{{ route('categories.index') }}">Listar Categorias</a>
                                    <a class="dropdown-item no-border text-dark" href="{{ route('categories.create') }}">Adicionar Categoria</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="publishersDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Editoras
                                </a>
                                <div class="dropdown-menu" aria-labelledby="publishersDropdown">
                                    <a class="dropdown-item no-border text-dark" href="{{ route('publishers.index') }}">Listar Editoras</a>
                                    <a class="dropdown-item no-border text-dark" href="{{ route('publishers.create') }}">Adicionar Editora</a>
                                </div>
                            </li>
                        @endcan
                    </ul>

                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item no-border text-dark" href="{{ route('logout') }}"
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
