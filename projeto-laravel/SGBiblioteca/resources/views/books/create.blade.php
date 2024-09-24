@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Adicionar Novo Livro</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label"><h5>Título:</h5></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="author_id" class="form-label"><h5>Autor:</h5></label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <option value="" disabled selected>Selecione um Autor</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="publisher_id" class="form-label"><h5>Editora:</h5></label>
                    <select class="form-control" id="publisher_id" name="publisher_id" required>
                        <option value="" disabled selected>Selecione uma Editora</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="published_year" class="form-label"><h5>Ano de Publicação:</h5></label>
                    <input type="number" class="form-control" id="published_year" name="published_year" value="{{ old('published_year') }}" required>
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label"><h5>Categorias:</h5></label>
                    <select class="form-control" id="categories" name="categories[]" multiple required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Segure a tecla Ctrl para selecionar várias categorias.</div>
                </div>
                <div class="mb-4">
                    <label for="cover_image" class="form-label"><h5>Capa do Livro:</h5></label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/jpeg,image/png" required>
                </div>
                <div class="d-flex justify-content-between"> 
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
