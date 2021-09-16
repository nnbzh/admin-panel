<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return Response|bool
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return Response|bool
     */
    public function update(User $user, User $model)
    {
        return $user->hasRole('manager');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function delete(User $user)
    {
        return $user->hasRole('manager');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function forceDelete(User $user)
    {
        return $user->hasRole('manager');
    }
}
