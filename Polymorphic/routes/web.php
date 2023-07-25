<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Photo;
use App\Models\Product;

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

    $staff = Staff::findOrFail(1);

    $staff->photos()->create(['path' => 'Myself.jpg']);
});

Route::get('/read', function () {

    $staff = Staff::findOrFail(1);

    foreach ($staff->photos as $photo) {

        return $photo->path;
    }
});

Route::get('/update', function () {

    $staff = Staff::findOrFail(1);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = "Updating Myself.jpg";

    $photo->save();
});

Route::get('/delete', function () {

    $staff = Staff::findOrFail(1);

    $staff->photos()->whereId(1)->delete();
});


Route::get('/assign', function () {

    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(4);

    $staff->photos()->save($photo);
});

Route::get('/unassign', function () {

    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(4);

    $staff->photos()->whereId(4)->update(['imageable_id' => '', 'imageable_type' => '']);
});
