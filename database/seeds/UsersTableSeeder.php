<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create super admin user
        User::create([
            'name' => 'Super admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        /*
         * Create roles
         */

        /** @var Role $administratorRole */
        $administratorRole = Role::create([
            'name' => 'administrator',
            'en' => [
                'display_name' => 'Administrator',
                'description' => 'Access to mostly web features',
            ],
            'fr' => [
                'display_name' => 'Administrateur',
                'description' => 'Accès à la plupart des fonctionnalités du site',
            ],
            'order' => 0,
        ]);

        foreach ([
            'access backend',
            'manage posts',
            'manage own posts',
            'publish posts',
            'manage form_settings',
            'manage form_submissions',
            'manage users',
            'impersonate users',
            'manage roles',
            'manage metas',
            'manage redirections',
        ] as $name) {
            $administratorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $supervisorRole */
        $supervisorRole = Role::create([
            'name' => 'supervisor',
            'en' => [
                'display_name' => 'Supervisor',
                'description' => 'Access to non critical web features (access and seo management excluded)',
            ],
            'fr' => [
                'display_name' => 'Superviseur',
                'description' => 'Accès à l\'ensemble des fonctionnalités non critiques du site (exclusion de la gestion des accès et seo)',
            ],
            'order' => 1,
        ]);

        foreach ([
            'access backend',
            'manage posts',
            'manage own posts',
            'publish posts',
            'manage form_settings',
            'manage form_submissions',
            'manage users',
        ] as $name) {
            $supervisorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $seoConsultantRole */
        $seoConsultantRole = Role::create([
            'name' => 'seo consultant',
            'en' => [
                'display_name' => 'SEO consultant',
                'description' => 'Access to manage metatags and redirections',
            ],
            'fr' => [
                'display_name' => 'Consultant SEO',
                'description' => 'Accès à la gestion des metatags et redirections.',
            ],
            'order' => 2,
        ]);

        foreach ([
            'access backend',
            'manage metas',
            'manage redirections',
        ] as $name) {
            $seoConsultantRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $editorRole */
        $editorRole = Role::create([
            'name' => 'editor',
            'en' => [
                'display_name' => 'Editor',
                'description' => 'Access to all posts writing features',
            ],
            'fr' => [
                'display_name' => 'Editeur',
                'description' => 'Accès à l\'ensemble des fonctions de rédaction du site',
            ],
            'order' => 3,
        ]);

        foreach ([
            'access backend',
            'manage posts',
            'manage own posts',
            'publish posts',
        ] as $name) {
            $editorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $redactorRole */
        $redactorRole = Role::create([
            'name' => 'redactor',
            'en' => [
                'display_name' => 'Redactor',
                'description' => 'Access to posts writing features, but restricted to his own posts',
            ],
            'fr' => [
                'display_name' => 'Rédacteur',
                'description' => 'Accès aux fonctions de rédaction du site, avec possibilité d\'éditer uniquement ses propres articles',
            ],
            'order' => 3,
        ]);

        foreach ([
            'access backend',
            'manage own posts',
        ] as $name) {
            $redactorRole->permissions()->create(['name' => $name]);
        }

        // 1 administrator
        /** @var User $administrator */
        $administrator = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        $administrator->roles()->save($administratorRole);

        // 1 supervisor
        /** @var User $supervisor */
        $supervisor = User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        $supervisor->roles()->save($supervisorRole);

        // 1 seo consultant
        /** @var User $seoConsultant */
        $seoConsultant = User::create([
            'name' => 'Seo consultant',
            'email' => 'seo@example.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        $seoConsultant->roles()->save($seoConsultantRole);
        $seoConsultant->roles()->save($editorRole);

        // 1 editor
        /** @var User $editor */
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        $editor->roles()->save($editorRole);

        // 5 redactors
        for ($i = 1; $i <= 5; ++$i) {
            /** @var User $redactor */
            $redactor = User::create([
                'name' => "Redactor $i",
                'email' => "redactor-$i@example.com",
                'password' => bcrypt('secret'),
                'active' => true,
                'confirmed' => true,
                'locale' => app()->getLocale(),
                'timezone' => config('app.timezone'),
            ]);

            $redactor->roles()->save($redactorRole);
        }

        // 10 random client users
        factory(User::class)->times(10)->create();
    }
}
