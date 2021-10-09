<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, User $providedUser)
    {
        return ($user->id == $providedUser->id) || ($providedUser->manager()->first() && $providedUser->manager()->first()->id == $user->id);
    }
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
