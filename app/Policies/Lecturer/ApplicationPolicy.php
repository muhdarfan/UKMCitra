<?php

namespace App\Policies\Lecturer;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
        return $user->role === 'lecturer';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Application $application)
    {
        //
        return $user->applications->contains('courseCode', $application->courseCode) && $user->matric_no === $application->matric_no;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Application $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Application $application)
    {
        //
        return $user->citras->contains('courseCode', $application->courseCode);
    }
}
