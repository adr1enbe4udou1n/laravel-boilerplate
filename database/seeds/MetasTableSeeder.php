<?php

use App\Models\Meta;
use Illuminate\Database\Seeder;

class MetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \InvalidArgumentException
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function run()
    {
        /** @var Meta $meta */
        $meta = factory(Meta::class)->make();
        $meta->route = 'home';
        $meta->save();

        $meta = factory(Meta::class)->make();
        $meta->route = 'about';
        $meta->save();

        $meta = factory(Meta::class)->make();
        $meta->route = 'blog';
        $meta->save();

        $meta = factory(Meta::class)->make();
        $meta->route = 'contact';
        $meta->save();
    }
}
