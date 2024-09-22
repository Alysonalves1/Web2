<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();
        return view('authors.index', compact('authors'));
    }

    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return view('authors.show', compact('author'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
        ]);

        Author::create($validatedData);

        return redirect()->route('authors.index')->with('success', 'Autor criado com sucesso!');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
        ]);

        $author = Author::findOrFail($id);
        $author->update($validatedData);

        return redirect()->route('authors.index')->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Autor excluído com sucesso!');
    }
}
