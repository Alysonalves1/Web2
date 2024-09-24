<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('users.index', compact('users')); Retorna a view com a lista de usuários
    }

    public function create()
    {
        return view('users.create'); para criar um novo usuário
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'role' => 'required|string|max:50', Validação para o campo role
        ]);

        
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), 
            'role' => $validatedData['role'], o role
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!'); Redireciona após a criação
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    $roles = ['admin', 'bibliotecario', 'cliente']; Defina as opções de perfil

    return view('users.edit', compact('user', 'roles')); 
}


public function update(Request $request, $id)
{
    
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, atual na validação única
        'password' => 'nullable|string|min:8|confirmed', 
        'role' => 'required|string|in:admin,bibliotecario,cliente', valores específicos
    ]);

    
    $user = User::findOrFail($id);

    
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->role = $validatedData['role']; role

    
    if ($request->filled('password')) {
        $user->password = Hash::make($validatedData['password']); 
    }

    
    $user->save();

    sucesso
    return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id); pelo ID
        $user->delete(); 

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!'); Redireciona após a exclusão
    }
}
