<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('books')->get();
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('books')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->books()->detach();
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
