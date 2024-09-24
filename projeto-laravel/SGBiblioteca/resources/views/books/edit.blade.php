@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Editar Livro</h1>
    <div class="row justify-content-center">
        <div class="col-md-8"> <
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label"><h5>Título:</h5></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="author_id" class="form-label"><h5>Autor:</h5></label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <option value="">Selecione um Autor</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="publisher_id" class="form-label"><h5>Editora:</h5></label>
                    <select class="form-control" id="publisher_id" name="publisher_id" required>
                        <option value="">Selecione uma Editora</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="published_year" class="form-label"><h5>Ano de Publicação:</h5></label>
                    <input type="number" class="form-control" id="published_year" name="published_year" value="{{ old('published_year', $book->published_year) }}" required>
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label"><h5>Categorias:</h5></label>
                    <select class="form-control" id="categories" name="categories[]" multiple required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Segure a tecla Ctrl para selecionar várias categorias.</div>
                </div>
                <div class="mb-4">
                    <label for="cover_image" class="form-label"><h5>Imagem de Capa:</h5></label>
                    @if($book->cover_image)
                        <div>
                            <img src="{{ asset($book->cover_image) }}" alt="Capa do livro" class="img-fluid mb-2" style="max-height: 200px;">
                        </div>
                    @else
                        <p>Imagem não disponível</p>
                    @endif
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/jpeg,image/png">
                </div>
                <div class="d-flex justify-content-between"> <
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
