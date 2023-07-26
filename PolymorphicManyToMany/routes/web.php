<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Video;

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

    $post = Post::create(['name' => 'My FIRST Post']);

    $tag1 = Tag::find(1);
    $post->tags()->attach($tag1);

    $video = Video::create(['name' => 'Video.mp4']);

    $tag2 = Tag::find(2);
    $video->tags()->attach($tag2);
});

Route::get('/read', function () {

    $post = Post::findOrFail(6);

    foreach ($post->tags as $tag) {

        echo $tag;
    }
});

Route::get('/update', function () {

    // $post = Post::findOrFail(6);

    // foreach ($post->tags as $tag) {

    //     return $tag->whereName('PHP')->update(['name' => 'Php Updated']);
    // }

    $post = Post::findOrFail(6);

    $tag = Tag::find(1);

    $post->tags()->sync([2]);
});


Route::get('/delete', function () {

    $post = Post::findOrFail(7);

    foreach ($post->tags as $tag) {

        $tag->whereId(2)->delete();
    }
});
