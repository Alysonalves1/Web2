<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        // Verifica se o usuário tem permissão para visualizar qualquer livro

        $books = Book::with(['author', 'publisher', 'categories'])->get();
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        // Verifica se o usuário tem permissão para visualizar o livro específico
        $book = Book::with(['author', 'publisher', 'categories'])->findOrFail($id);
        $this->authorize('view', $book);

        return view('books.show', compact('book'));
    }

    public function create()
    {
        // Verifica se o usuário tem permissão para criar livros
        $this->authorize('create', Book::class);

        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'publishers', 'categories'));
    }

    public function store(Request $request)
    {
        // Verifica se o usuário tem permissão para criar livros
        $this->authorize('create', Book::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'published_year' => 'required|integer',
            'categories' => 'required|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $imageName = time().'.'.$request->cover_image->extension();
            $request->cover_image->move(public_path('images'), $imageName);
            $validatedData['cover_image'] = 'images/' . $imageName;
        }

        $book = Book::create($validatedData);
        $book->categories()->attach($request->categories);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        // Verifica se o usuário tem permissão para editar o livro
        $this->authorize('update', $book);

        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authors', 'publishers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // Verifica se o usuário tem permissão para atualizar o livro
        $this->authorize('update', $book);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'published_year' => 'required|integer',
            'categories' => 'required|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                $oldImagePath = public_path($book->cover_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time().'.'.$request->cover_image->extension();
            $request->cover_image->move(public_path('images'), $imageName);
            $validatedData['cover_image'] = 'images/' . $imageName;
        }

        $book->update($validatedData);
        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Verifica se o usuário tem permissão para excluir o livro
        $this->authorize('delete', $book);

        if ($book->cover_image && file_exists(public_path($book->cover_image))) {
            unlink(public_path($book->cover_image));
        }

        $book->categories()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}
