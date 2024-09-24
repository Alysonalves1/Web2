@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Livros</h1>

        @can('create', App\Models\Book::class)
            <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Adicionar Novo Livro</a>
        @endcan

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Categorias</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>
                            @if ($book->cover_image) 
                                <img src="{{ asset( $book->cover_image) }}" style="width: 150px; height: auto;">
                            @else
                                Imagem Indisponível
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->publisher->name }}</td>
                        <td>
                            @foreach ($book->categories as $category)
                                <span class="badge bg-secondary">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">Ver</a>

                            @can('update', $book)
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Editar</a>
                            @endcan

                            @can('delete', $book)
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @can('viewAny', App\Models\User::class)
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Gerenciar Usuários</a>
        @endcan
    </div>
@endsection
