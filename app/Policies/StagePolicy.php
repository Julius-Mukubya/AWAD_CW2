<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Stage;
use Illuminate\Auth\Access\HandlesAuthorization;

class StagePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true; // Admin can do everything
        }
    }

    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'operator', 'viewer']);
    }

    public function view(User $user, Stage $stage)
    {
        return in_array($user->role, ['admin', 'operator', 'viewer']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'operator']);
    }

    public function update(User $user, Stage $stage)
    {
        return in_array($user->role, ['admin', 'operator']);
    }

    public function delete(User $user, Stage $stage)
    {
        return $user->role === 'admin';
    }
}