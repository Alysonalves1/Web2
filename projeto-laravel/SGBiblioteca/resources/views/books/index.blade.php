@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Livros</h1>

        @can('create', App\Models\Book::class)
            <a href="{{ route('books.create') }}" class="btn btn-primary mb-4 mt-2">Adicionar Novo Livro</a>
        @endcan

        @foreach ($books as $book)
            <div class="border-bottom mb-5 pb-4">
                <div class="row">
                    <div class="col-md-2">
                        @if ($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" class="img-fluid" alt="Capa do livro">
                        @else
                            <div class="text-center">Imagem Indisponível</div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <h5>{{ $book->title }}</h5>
                        <p><strong>Autor:</strong> {{ $book->author->name }}</p>
                        <p><strong>Editora:</strong> {{ $book->publisher->name }}</p>
                        <p><strong>Ano de Publicação:</strong> {{ $book->published_year }}</p>
                        <p><strong>Categorias:</strong>
                            @foreach ($book->categories as $category)
                                <span class="badge bg-secondary">{{ $category->name }}</span>
                            @endforeach
                        </p>
                        <div class="gp" role="group">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info mg-5">Ver</a>

                            @can('update', $book)
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning me-4">Editar</a> 
                            @endcan

                            @can('delete', $book)
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @can('viewAny', App\Models\User::class)
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Gerenciar Usuários</a>
        @endcan
    </div>
@endsection
