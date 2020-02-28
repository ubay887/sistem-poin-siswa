<?php

namespace App\Policies;

use App\Entities\Users\User;
use App\Entities\Students\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the student.
     *
     * @param  \App\Entities\Users\User  $user
     * @param  \App\Entities\Students\Student  $student
     * @return mixed
     */
    public function view(User $user, Student $student)
    {
        // Update $user authorization to view $student here.
        return true;
    }

    /**
     * Determine whether the user can create student.
     *
     * @param  \App\Entities\Users\User  $user
     * @param  \App\Entities\Students\Student  $student
     * @return mixed
     */
    public function create(User $user, Student $student)
    {
        // Update $user authorization to create $student here.
        return true;
    }

    /**
     * Determine whether the user can update the student.
     *
     * @param  \App\Entities\Users\User  $user
     * @param  \App\Entities\Students\Student  $student
     * @return mixed
     */
    public function update(User $user, Student $student)
    {
        // Update $user authorization to update $student here.
        return true;
    }

    /**
     * Determine whether the user can delete the student.
     *
     * @param  \App\Entities\Users\User  $user
     * @param  \App\Entities\Students\Student  $student
     * @return mixed
     */
    public function delete(User $user, Student $student)
    {
        // Update $user authorization to delete $student here.
        return true;
    }
}
