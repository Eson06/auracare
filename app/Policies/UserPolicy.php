<?php

namespace App\Policies;

use App\Models\User;
use App\Models\user_role;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }

    public function SuperadminRole(User $user) {
        if(auth('web')->check()) {
            $Check =user_role::where('user_id', auth('web')->user()->id)->where('role_id','1')->get()->first();
            if ($Check) {
                return $user;
            }
        }

    }
        

    public function AdminRole(User $user)
{
    if (auth('web')->check()) {
        $hasRole = user_role::where('user_id', auth('web')->id())
            ->whereIn('role_id', [1, 2])
            ->exists();

        if ($hasRole) {
            return $user;
        }
    }

    return null;
}

    public function BusinessRole(User $user)
{
    if (auth('web')->check()) {
        $hasRole = user_role::where('user_id', auth('web')->id())
            ->whereIn('role_id', [1, 3])
            ->exists();

        if ($hasRole) {
            return $user;
        }
    }
}

    public function CustomerRole(User $user)
{
    if (auth('web')->check()) {
        $hasRole = user_role::where('user_id', auth('web')->id())
            ->whereIn('role_id', [1, 4])
            ->exists();

        if ($hasRole) {
            return $user;
        }
    }
}

}
