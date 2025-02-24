<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Plan;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Plan $plan)
    {
        return $user->id === $plan->user_id;
    }

    public function delete(User $user, Plan $plan): bool
    {
        return $user->id === $plan->user_id;
    }

}
