<?php

namespace App\Policies;

use App\User;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user, User $user)
    {
        // Update $user authorization to view $user here.
        return true;
    }

    /**
     * Determine whether the user can create user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, User $user)
    {
        // Update $user authorization to create $user here.
        return true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, User $user)
    {
        // Update $user authorization to update $user here.
        return true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user, User $user)
    {
        // Update $user authorization to delete $user here.
        return true;
    }
}
