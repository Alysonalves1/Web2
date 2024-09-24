<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user)
    {

        return $user->role === 'admin';
    }
    public function adminOrLibrarian(User $user)
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

}
