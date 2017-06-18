<?php

use App\Models\User;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $users
     * @param RoleRepository $roles
     */
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create super admin user
        $this->users->store([
            'name' => 'Super admin',
            'email' => 'superadmin@example.com',
            'password' => 'secret',
            'active' => true,
        ], true);

        // Create roles
        $administratorRole = $this->roles->store([
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
            'permissions' => [
                'access backend',
                'manage posts',
                'manage own posts',
                'manage form_settings',
                'manage form_submissions',
                'manage users',
                'impersonate users',
                'manage roles',
                'manage metas',
                'manage redirections',
            ],
        ]);

        $supervisorRole = $this->roles->store([
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
            'permissions' => [
                'access backend',
                'manage posts',
                'manage own posts',
                'manage form_settings',
                'manage form_submissions',
                'manage users',
            ],
        ]);

        $seoConsultantRole = $this->roles->store([
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
            'permissions' => [
                'access backend',
                'manage metas',
                'manage redirections',
            ],
        ]);

        $editorRole = $this->roles->store([
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
            'permissions' => [
                'access backend',
                'manage posts',
                'manage own posts',
            ],
        ]);

        $redactorRole = $this->roles->store([
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
            'permissions' => [
                'access backend',
                'manage own posts',
            ],
        ]);

        // 1 administrator
        $this->users->store([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => 'secret',
            'active' => true,
            'roles' => [
                $administratorRole->id,
            ],
        ], true);

        // 1 supervisor
        $this->users->store([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'password' => 'secret',
            'active' => true,
            'roles' => [
                $supervisorRole->id,
            ],
        ], true);

        // 1 seo consultant
        $this->users->store([
            'name' => 'Seo consultant',
            'email' => 'seo@example.com',
            'password' => 'secret',
            'active' => true,
            'roles' => [
                $seoConsultantRole->id,
                $editorRole->id,
            ],
        ], true);

        // 1 editor
        $this->users->store([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => 'secret',
            'active' => true,
            'roles' => [
                $editorRole->id,
            ],
        ], true);

        // 5 redactors
        for ($i = 1; $i <= 5; ++$i) {
            $this->users->store([
                'name' => "Redactor $i",
                'email' => "redactor-$i@example.com",
                'password' => 'secret',
                'active' => true,
                'roles' => [
                    $redactorRole->id,
                ],
            ], true);
        }

        // 10 random client users
        /* @var \Illuminate\Database\Eloquent\Collection $users */
        $users = factory(User::class)->times(10)->raw();

        foreach ($users as $attributes) {
            $this->users->store($attributes, true);
        }
    }
}
