<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 50 random posts
        /** @var \Illuminate\Database\Eloquent\Collection $posts */
        $posts = factory(Post::class)->times(50)->create();

        $publicDisk = Storage::disk('public');
        $publicDisk->delete($publicDisk->files('posts'));

        $posts->each(function (Post $post) {
            $i = mt_rand(1, 10);
            $imageData = database_path()."/seeds/images/abstract-$i.jpg";

            $media = MediaUploader::fromSource(fopen($imageData, 'rb'))
                ->toDestination('public', 'posts')
                ->useFilename(Str::random(32))
                ->upload();

            $post->attachMedia($media, 'featured image');
            $post->save();
        });
    }
}
