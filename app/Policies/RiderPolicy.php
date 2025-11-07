<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rider;
use Illuminate\Auth\Access\HandlesAuthorization;

class RiderPolicy
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

    public function view(User $user, Rider $rider)
    {
        return in_array($user->role, ['admin', 'operator', 'viewer']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'operator']);
    }

    public function update(User $user, Rider $rider)
    {
        return in_array($user->role, ['admin', 'operator']);
    }

    public function delete(User $user, Rider $rider)
    {
        return $user->role === 'admin';
    }

    public function approve(User $user, Rider $rider)
    {
        return $user->role === 'admin';
    }

    public function suspend(User $user, Rider $rider)
    {
        return $user->role === 'admin';
    }
}