<?php

namespace App\Policies;

use App\ClassName;
use App\Entities\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassNamePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the class_name.
     *
     * @param  \App\User  $user
     * @param  \App\ClassName  $className
     * @return mixed
     */
    public function view(User $user, ClassName $className)
    {
        // Update $user authorization to view $className here.
        return true;
    }

    /**
     * Determine whether the user can create class_name.
     *
     * @param  \App\User  $user
     * @param  \App\ClassName  $className
     * @return mixed
     */
    public function create(User $user, ClassName $className)
    {
        // Update $user authorization to create $className here.
        return true;
    }

    /**
     * Determine whether the user can update the class_name.
     *
     * @param  \App\User  $user
     * @param  \App\ClassName  $className
     * @return mixed
     */
    public function update(User $user, ClassName $className)
    {
        // Update $user authorization to update $className here.
        return true;
    }

    /**
     * Determine whether the user can delete the class_name.
     *
     * @param  \App\User  $user
     * @param  \App\ClassName  $className
     * @return mixed
     */
    public function delete(User $user, ClassName $className)
    {
        // Update $user authorization to delete $className here.
        return true;
    }
}
