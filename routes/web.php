<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => view('posts', [
    'posts' => Post::latest()->get(),
    'categories' => Category::all()
]))->name('home');

Route::get('posts/{post:slug}', fn (Post $post) => view('post', [
    'post' => $post
]));

Route::get('categories/{category:slug}', fn (Category $category) => view('posts', [
    'posts' => $category->posts,
    'currentCategory' => $category,
    'categories' => Category::all()
]))->name('category');

Route::get('authors/{author:username}', fn (User $author) => view('posts', [
    'posts' => $author->posts,
    'categories' => Category::all()
]));
