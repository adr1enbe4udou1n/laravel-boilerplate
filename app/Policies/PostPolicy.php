<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->can('manage posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User             $authenticatedUser
     * @param \App\Models\Post $post
     *
     * @return mixed
     * @internal param \App\Models\User $user
     *
     */
    public function update(User $authenticatedUser, Post $post)
    {
        return $authenticatedUser->id === $post->user_id;
    }
}
