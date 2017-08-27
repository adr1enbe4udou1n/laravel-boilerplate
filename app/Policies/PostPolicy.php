<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the user.
     *
     * @param User             $authenticatedUser
     * @param \App\Models\Post $post
     *
     * @return mixed
     *
     * @internal param \App\Models\User $user
     */
    public function view(User $authenticatedUser, Post $post)
    {
        if ($authenticatedUser->can('view posts')) {
            return true;
        }

        if ($authenticatedUser->can('view own posts')) {
            return $authenticatedUser->id === $post->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param User             $authenticatedUser
     * @param \App\Models\Post $post
     *
     * @return mixed
     *
     * @internal param \App\Models\User $user
     */
    public function update(User $authenticatedUser, Post $post)
    {
        if ($authenticatedUser->can('edit posts')) {
            return true;
        }

        if ($authenticatedUser->can('edit own posts')) {
            return $authenticatedUser->id === $post->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param User             $authenticatedUser
     * @param \App\Models\Post $post
     *
     * @return mixed
     *
     * @internal param \App\Models\User $user
     */
    public function delete(User $authenticatedUser, Post $post)
    {
        if ($authenticatedUser->can('delete posts')) {
            return true;
        }

        if ($authenticatedUser->can('delete own posts')) {
            return $authenticatedUser->id === $post->user_id;
        }

        return false;
    }
}
