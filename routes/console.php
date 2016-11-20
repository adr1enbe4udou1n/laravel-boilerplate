<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

use App\Models\User;

Artisan::command('user:create:admin {name} {email} {password}', function (
    $name, $email, $password) {

    $user = new User();
    $user->name = $name;
    $user->email = $email;
    $user->password = bcrypt($password);
    $user->role = User::ROLE_ADMIN;
    $user->save();

    $this->info("New admin user created !");
})->describe('Create Admin User');

Artisan::command('user:create {name} {email} {password}', function (
    $name, $email, $password) {

    $user = new User();
    $user->name = $name;
    $user->email = $email;
    $user->password = bcrypt($password);
    $user->role = User::ROLE_SUPERVISOR;
    $user->save();

    $this->info("New supervisor user created !");
})->describe('Create Supervisor User');
