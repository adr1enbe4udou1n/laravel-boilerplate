<?php

use App\Models\Meta;
use App\Models\Post;
use App\Models\User;
use Spatie\Tags\Tag;
use Illuminate\Database\Seeder;

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
        // Cleanup
        $publicDisk = Storage::disk('public');
        foreach ($publicDisk->directories() as $directory) {
            $publicDisk->deleteDirectory($directory);
        }

        $faker = Faker\Factory::create();
        $user = new User();

        // Get User ids with roles (those can create posts)
        $userIds = $user->select('id')->has('roles')->get();

        // 200 random posts
        /** @var \Illuminate\Database\Eloquent\Collection $posts */
        $posts = factory(Post::class)->times(200)->create();

        /** @var \Illuminate\Database\Eloquent\Collection $tags */
        $tags = factory(Tag::class)->times(20)->create();

        $posts->each(function (Post $post) use ($faker, $userIds, $tags) {
            //Attach user
            $post->user_id = $userIds->random()->id;

            // Attach media
            if ($faker->boolean(80)) {
                $i = mt_rand(1, 10);
                $imagePath = database_path()."/seeds/images/abstract-$i.jpg";

                $post->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('featured image');
            }

            // Generate localized bodies
            foreach (['en', 'fr', 'es', 'ar', 'ru', 'de', 'pt', 'zn'] as $locale) {
                $post->setTranslation('body', $locale, $this->generateBody($faker, $locale));
            }

            $post->save();

            // Set tags
            $post->tags()->saveMany($tags->random($faker->numberBetween(1, 10)));

            // Set metas
            $post->meta()->save(factory(Meta::class)->make());
        });
    }

    private function generateBody(Faker\Generator $faker, $locale)
    {
        // Generate body image
        $i = $faker->numberBetween(1, 10);
        $bodyImage = Image::make(database_path()."/seeds/images/abstract-{$i}.jpg")->widen(600, function ($constraint) {
            $constraint->upsize();
        });

        $bodyImagePath = "/tmp/image-{$locale}.png";

        Storage::disk('public')->put($bodyImagePath, $bodyImage->stream());
        $imageUrl = "/storage{$bodyImagePath}";

        // Generate body
        $align = $faker->randomElement(['left', 'center', 'right']);

        $imageHtml = <<<EOT
<figure class="image image-style-align-{$align}">
    <img src="{$imageUrl}" alt="">
    <figcaption>{$faker->sentence}</figcaption>
</figure>
EOT;

        $p1 = "<p>{$faker->paragraph($faker->numberBetween(30, 50))}</p>";
        $p2 = "<p>{$faker->paragraph($faker->numberBetween(30, 50))}</p>";

        $imagePosition = $faker->numberBetween(1, 2);

        if (1 === $imagePosition) {
            return $imageHtml.$p1.$p2;
        }

        return $p1.$imageHtml.$p2;
    }
}
