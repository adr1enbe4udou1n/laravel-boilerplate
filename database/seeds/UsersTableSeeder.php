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
        // Default password
        $defaultPassword = app()->environment('production') ? str_random() : 'secret';
        $this->command->getOutput()->writeln("<info>Default password:</info> $defaultPassword");

        // Create super admin user
        $user = new User();
        $role = new Role();

        $user->create([
            'name'              => 'Super admin',
            'email'             => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt($defaultPassword),
            'active'            => true,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);

        /*
         * Create roles
         */

        /** @var Role $administratorRole */
        $administratorRole = $role->create([
            'name'         => 'administrator',
            'display_name' => [
                'en' => 'Administrator',
                'fr' => 'Administrateur',
                'es' => 'Administrador',
                'ar' => 'مدير',
                'ru' => 'Администратор',
            ],
            'description' => [
                'en' => 'Access to mostly web features',
                'fr' => 'Accès à la plupart des fonctionnalités du site',
                'es' => 'Acceso a la mayoría de las características web',
                'ar' => 'قادر على الوصول إلى أغلب ميزات الموقع',
                'ru' => 'Доступ к большинству возможностей сайта',
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
            'name'         => 'supervisor',
            'display_name' => [
                'en' => 'Supervisor',
                'fr' => 'Superviseur',
                'es' => 'Supervisor',
                'ar' => 'مشرف',
                'ru' => 'Контролёр',
            ],
            'description' => [
                'en' => 'Access to non critical web features (access and seo management excluded)',
                'fr' => 'Accès à l\'ensemble des fonctionnalités non critiques du site (exclusion de la gestion des accès et seo)',
                'es' => 'Acceso a características web no críticas (acceso y administración de SEO excluidos)',
                'ar' => 'وصول إلى ميزات الموقع غير الحساسة (يستثنى منه الوصول وإدارة إعدادات تحسين محركات البحث)',
                'ru' => 'Доступ к некритичной функциональности (закрыт доступ к SEO функциям)',
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
            'name'         => 'seo consultant',
            'display_name' => [
                'en' => 'SEO consultant',
                'fr' => 'Consultant SEO',
                'es' => 'SEO consultant',
                'ar' => 'مستشار تحسين أداء محركات البحث',
                'ru' => 'SEO-консультант',
            ],
            'description' => [
                'en' => 'Access to manage metatags and redirections',
                'fr' => 'Accès à la gestion des metatags et redirections',
                'es' => 'Acceso para administrar metatags y redirecciones',
                'ar' => 'وصول وإدارة المعلومات الوصفية وقواعد التوجيه',
                'ru' => 'Доступ к управлению метаинформацией и перенаправлениями.',
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
            'name'         => 'editor',
            'display_name' => [
                'en' => 'Editor',
                'fr' => 'Editeur',
                'es' => 'Editor',
                'ar' => 'منقّح',
                'ru' => 'Редактор',
            ],
            'description' => [
                'en' => 'Access to all posts writing features',
                'fr' => 'Accès à l\'ensemble des fonctions de rédaction du site',
                'es' => 'Acceso a todas las publicaciones de escritura',
                'ar' => 'وصول إلى جميع ميزات كتابة المقالات',
                'ru' => 'Доступ к полному управлению статьями.',
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
            'name'         => 'redactor',
            'display_name' => [
                'en' => 'Redactor',
                'fr' => 'Rédacteur',
                'es' => 'Redactor',
                'ar' => 'محرر',
                'ru' => 'Писатель',
            ],
            'description' => [
                'en' => 'Access to posts writing features, but restricted to his own posts',
                'fr' => 'Accès aux fonctions de rédaction du site, avec possibilité d\'éditer uniquement ses propres articles',
                'es' => 'Acceso a las funciones de escritura de publicaciones, pero restringido a sus propias publicaciones',
                'ar' => 'وصول إلى ميزات كتابة المقالات فيما يخص المقالات الخاصة به فقط',
                'ru' => 'Доступ к полному управлению статьями. Но только своими.',
            ],
            'order' => 4,
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

        // 1 administrator
        /** @var User $administrator */
        $administrator = $user->create([
            'name'              => 'Administrator',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt($defaultPassword),
            'active'            => true,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);

        $administrator->roles()->save($administratorRole);

        // 1 supervisor
        /** @var User $supervisor */
        $supervisor = $user->create([
            'name'              => 'Supervisor',
            'email'             => 'supervisor@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt($defaultPassword),
            'active'            => true,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);

        $supervisor->roles()->save($supervisorRole);

        // 1 demo
        /** @var User $demo */
        $demo = $user->create([
            'name'              => 'Demo',
            'email'             => 'demo@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('demo'),
            'active'            => true,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);

        $demo->roles()->save($administratorRole);

        // 1 seo consultant
        /** @var User $seoConsultant */
        $seoConsultant = $user->create([
            'name'              => 'Seo consultant',
            'email'             => 'seo@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt($defaultPassword),
            'active'            => true,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);

        $seoConsultant->roles()->save($seoConsultantRole);
        $seoConsultant->roles()->save($editorRole);

        // 1 editor
        /** @var User $editor */
        $editor = $user->create([
            'name'              => 'Editor',
            'email'             => 'editor@example.com',
            'email_verified_at' => now(),
            'password'          => bcrypt($defaultPassword),
            'active'            => true,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);

        $editor->roles()->save($editorRole);

        // 5 redactors
        for ($i = 1; $i <= 5; $i++) {
            /** @var User $redactor */
            $redactor = $user->create([
                'name'              => "Redactor $i",
                'email'             => "redactor-$i@example.com",
                'email_verified_at' => now(),
                'password'          => bcrypt($defaultPassword),
                'active'            => true,
                'locale'            => app()->getLocale(),
                'timezone'          => config('app.timezone'),
            ]);

            $redactor->roles()->save($redactorRole);
        }

        // 10 random client users
        factory(User::class)->times(10)->create();
    }
}
