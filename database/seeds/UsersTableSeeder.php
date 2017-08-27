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
        $user = new User();
        $role = new Role();

        $user->create([
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
        $administratorRole = $role->create([
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

        foreach (
            [
                'access backend',
                'view posts',
                'create posts',
                'edit posts',
                'delete posts',
                'publish posts',
                'view form_settings',
                'create form_settings',
                'edit form_settings',
                'delete form_settings',
                'view form_submissions',
                'delete form_submissions',
                'view users',
                'create users',
                'edit users',
                'delete users',
                'impersonate users',
                'view roles',
                'create roles',
                'edit roles',
                'delete roles',
                'view metas',
                'create metas',
                'edit metas',
                'delete metas',
                'view redirections',
                'create redirections',
                'edit redirections',
                'delete redirections',
            ] as $name) {
            $administratorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $supervisorRole */
        $supervisorRole = $role->create([
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

        foreach (
            [
                'access backend',
                'view posts',
                'create posts',
                'edit posts',
                'delete posts',
                'publish posts',
                'view form_settings',
                'create form_settings',
                'edit form_settings',
                'delete form_settings',
                'view form_submissions',
                'delete form_submissions',
                'view users',
                'create users',
                'edit users',
                'delete users',
            ] as $name) {
            $supervisorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $seoConsultantRole */
        $seoConsultantRole = $role->create([
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

        foreach (
            [
                'access backend',
                'view metas',
                'create metas',
                'edit metas',
                'delete metas',
                'view redirections',
                'create redirections',
                'edit redirections',
                'delete redirections',
            ] as $name) {
            $seoConsultantRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $editorRole */
        $editorRole = $role->create([
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

        foreach (
            [
                'access backend',
                'view posts',
                'create posts',
                'edit posts',
                'delete posts',
                'publish posts',
            ] as $name) {
            $editorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $redactorRole */
        $redactorRole = $role->create([
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

        foreach (
            [
                'access backend',
                'view own posts',
                'create posts',
                'edit own posts',
                'delete own posts',
            ] as $name) {
            $redactorRole->permissions()->create(['name' => $name]);
        }

        /** @var Role $demoRole */
        $demoRole = $role->create([
            'name' => 'demo',
            'en' => [
                'display_name' => 'Demo',
                'description' => 'Access to all read only BO functionalities',
            ],
            'fr' => [
                'display_name' => 'Démo',
                'description' => 'Accès à l\'ensemble des fonctionnalités du BO en lecture seule',
            ],
            'order' => 3,
        ]);

        foreach (
            [
                'access backend',
                'access all backend',
                'view posts',
                'view form_settings',
                'view form_submissions',
                'view users',
                'view roles',
                'view metas',
                'view redirections',
            ] as $name) {
            $demoRole->permissions()->create(['name' => $name]);
        }

        // 1 administrator
        /** @var User $administrator */
        $administrator = $user->create([
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
        $supervisor = $user->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        $supervisor->roles()->save($supervisorRole);

        // 1 demo
        /** @var User $demo */
        $demo = $user->create([
            'name' => 'Demo',
            'email' => 'demo@example.com',
            'password' => bcrypt('demo'),
            'active' => true,
            'confirmed' => true,
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);

        $demo->roles()->save($demoRole);

        // 1 seo consultant
        /** @var User $seoConsultant */
        $seoConsultant = $user->create([
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
        $editor = $user->create([
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
            $redactor = $user->create([
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
