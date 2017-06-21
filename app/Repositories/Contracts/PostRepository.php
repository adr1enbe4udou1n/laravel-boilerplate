<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use App\Models\Tag;

/**
 * Interface PostRepository.
 */
interface PostRepository extends BaseRepository
{
    /**
     * @param Tag $tag
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function published(Tag $tag = null);

    /**
     * @param string $slug
     *
     * @return Post
     */
    public function findBySlug($slug);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param Post  $post
     * @param array $input
     *
     * @return mixed
     */
    public function update(Post $post, array $input);

    /**
     * @param Post $post
     *
     * @return mixed
     */
    public function destroy(Post $post);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchPublish(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchPromote(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchPin(array $ids);

    /**
     * @param \App\Models\Post $post
     *
     * @return mixed
     */
    public function getActionButtons(Post $post);
}
