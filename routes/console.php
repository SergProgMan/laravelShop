<?php

use Illuminate\Foundation\Inspiring;

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

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('create-admin {email} {pass}', function($email, $pass){
    $user = new App\User;
    $emailParts = explode('@', $email);
    $user->email = $email;
    $user->password = bcrypt($pass);
    $user->name = $emailParts[0];
    $user->admin = 1;
    $result = $user->save();
    if($result){
        echo "Success! Admin user created!".PHP_EOL;
    } else {
        echo "Error!".PHP_EOL;
    }
});