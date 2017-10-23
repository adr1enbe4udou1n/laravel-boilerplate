<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Contracts\PostRepository;

class AutoPublishPostTrigger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto publish posts according to publish/unpublish dates';

    /**
     * @var \App\Repositories\Contracts\PostRepository
     */
    private $posts;

    /**
     * Create a new command instance.
     *
     * @param \App\Repositories\Contracts\PostRepository $posts
     */
    public function __construct(PostRepository $posts)
    {
        parent::__construct();

        $this->posts = $posts;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();

        $this->posts->query()
            ->where('status', '!=', Post::PUBLISHED)
            ->where('published_at', '<', $now)
            ->where(function (Builder $q) use ($now) {
                $q
                    ->whereNull('unpublished_at')
                    ->orWhere('unpublished_at', '>', $now);
            })
            ->update(['status' => Post::PUBLISHED]);

        $this->posts->query()
            ->where('status', '=', Post::PUBLISHED)
            ->where('unpublished_at', '<', $now)
            ->update(['status' => Post::DRAFT]);
    }
}
