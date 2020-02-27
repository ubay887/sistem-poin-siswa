<?php

namespace App\Policies;

use App\Entities\Users\User;
use App\Entities\Options\Option;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create option.
     *
     * @param  \App\User  $user
     * @param  \App\Entities\Options\Option;  $option
     * @return mixed
     */
    // public function create(User $user, Option $option)
    // {
    //     // Update $user authorization to create $option here.
    //     return true;
    // }

    /**
     * Determine whether the user can update the option.
     *
     * @param  \App\User  $user
     * @param  \App\Entities\Options\Option;  $option
     * @return mixed
     */
    public function update(User $user, Option $option)
    {
        // Update $user authorization to update $option here.
        return true;
    }

    /**
     * Determine whether the user can delete the option.
     *
     * @param  \App\User  $user
     * @param  \App\Entities\Options\Option;  $option
     * @return mixed
     */
    // public function delete(User $user, Option $option)
    // {
    //     // Update $user authorization to delete $option here.
    //     return true;
    // }
}
