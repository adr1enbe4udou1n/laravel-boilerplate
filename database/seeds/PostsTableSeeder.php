<?php

use App\Models\Meta;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \InvalidArgumentException
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = new User();

        // Get User ids with roles (those can create posts)
        $userIds = $user->select('id')->has('roles')->get();

        // 50 random posts
        /** @var \Illuminate\Database\Eloquent\Collection $posts */
        $posts = factory(Post::class)->times(200)->create();

        /** @var \Illuminate\Database\Eloquent\Collection $tags */
        $tags = factory(Tag::class)->times(20)->create();

        $publicDisk = Storage::disk('public');
        $publicDisk->delete($publicDisk->files('posts'));

        $posts->each(function (Post $post) use ($faker, $userIds, $tags) {
            //Attach user
            $post->user_id = $userIds->random()->id;

            // Attach media
            $i = mt_rand(1, 10);
            $imageData = database_path()."/seeds/images/abstract-$i.jpg";

            $media = MediaUploader::fromSource(fopen($imageData, 'rb'))
                ->toDestination('public', 'posts')
                ->useFilename(Str::random(32))
                ->upload();

            $post->attachMedia($media, 'featured image');
            $post->save();

            // Set tags
            $post->tags()->saveMany($tags->random($faker->numberBetween(1, 10)));

            // Set metas
            $post->meta()->save(factory(Meta::class)->make());
        });
    }
}
