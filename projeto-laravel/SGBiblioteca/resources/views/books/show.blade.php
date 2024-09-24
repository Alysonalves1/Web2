@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>
        <p><strong>Autor:</strong> {{ $book->author->name }}</p>
        <p><strong>Editora:</strong> {{ $book->publisher->name }}</p>
        <p><strong>Ano de Publicação:</strong> {{ $book->published_year }}</p>
        <p><strong>Categorias:</strong>
            @foreach ($book->categories as $category)
                <span class="badge bg-secondary">{{ $category->name }}</span>
            @endforeach
        </p>
        @if($book->cover_image)
            <img src="{{ asset($book->cover_image) }}" alt="Capa do livro" class="img-fluid mb-3">
        @else
            <p>Imagem não disponível</p>
        @endif
        <div class="mt-3">
            <a href="{{ route('books.index') }}" class="btn btn-primary">Voltar à Lista</a>
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
            </form>
        </div>

        <div class="mt-5">
            <h2>Comentários</h2>
            @foreach($book->comments as $comment)
                <div class="border p-2 mb-2">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }} <br>
                    <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach

            @if(Auth::check())
                <form action="{{ route('comments.store', $book->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="comment" rows="3" class="form-control" required placeholder="Deixe seu comentário..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Adicionar Comentário</button>
                </form>
            @else
                <p class="text-muted">Faça login para deixar um comentário.</p>
            @endif
        </div>
    </div>
@endsection
