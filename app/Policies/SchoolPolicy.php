<?php

namespace App\Policies;

use App\School;
use App\Entities\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    // public function create(User $user, School $school)
    // {
    //     // Update $user authorization to create $school here.
    //     return true;
    // }

    /**
     * Determine whether the user can update the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function update(User $user, School $school)
    {
        // Update $user authorization to update $school here.
        return true;
    }

    /**
     * Determine whether the user can delete the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    // public function delete(User $user, School $school)
    // {
    //     // Update $user authorization to delete $school here.
    //     return true;
    // }
}
