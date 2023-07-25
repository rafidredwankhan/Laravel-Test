<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create', function () {

    $user = User::findOrFail(1);

    $role = new Role(['name' => 'Reporter']);

    $user->roles()->save($role);
});



Route::get('/read', function () {

    $user =  User::findOrFail(1);

    foreach ($user->roles as $role) {

        echo $role->name;
    }
});



Route::get('/update',  function () {

    $user = User::findOrFail(1);

    if ($user->has('roles')) {

        foreach ($user->roles as $role) {

            if ($role->name == 'administrator') {

                $role->name = "Subscriber";
                $role->save();
            }
        }
    }
});


Route::get('/delete', function () {

    $user = User::findOrFail(1);

    $user->roles()->whereRoleId(2)->delete();
});


//Attaching, Detaching and Syncing Role_Id to the Users
Route::get('/attach', function () {

    $user = User::findOrFail(1);

    $user->roles()->attach(2);
});

Route::get('/detach', function () {

    $user = User::findOrFail(1);

    $user->roles()->detach();
});

Route::get('/sync', function () {

    $user = User::findOrFail(2);

    $user->roles()->sync([1]);
});
