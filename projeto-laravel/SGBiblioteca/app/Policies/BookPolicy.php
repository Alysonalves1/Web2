<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    public function viewAny(User $user)
    {
    return $user->hasRole('admin') || $user->hasRole('bibliotecario');
    }

    public function view(User $user, Book $book)
    {
    return $user->hasRole('admin') || $user->hasRole('bibliotecario') || $user->hasRole('cliente');
    }

    public function create(User $user)
    {
    return $user->hasRole('admin') || $user->hasRole('bibliotecario');
    }

    public function update(User $user, Book $book)
    {
    return $user->hasRole('admin') || $user->hasRole('bibliotecario');
    }

    public function delete(User $user, Book $book)
    {
    return $user->hasRole('admin');
    }

}
