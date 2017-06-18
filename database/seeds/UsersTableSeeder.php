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
     * @param UserRepository  $users
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
        $this->roles->store([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'This role allow user to access to mostly web features'
        ]);

        /** @var \Illuminate\Database\Eloquent\Collection $users */
        $users = factory(User::class)->times(5)->raw();

        foreach($users as $attributes) {
            $this->users->store($attributes, true);
        }
    }
}
