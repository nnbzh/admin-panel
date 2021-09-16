<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function manage(User $user)
    {
        return $user->hasRole('manager');
    }
}
