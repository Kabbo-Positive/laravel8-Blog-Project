<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Start User Route
Route::get('/',[FrontendController::class,'index']);

Route::get('/learn/{category_slug}',[FrontendController::class,'viewCategoryPost']);
Route::get('/learn/{category_slug}/{post_stug}',[FrontendController::class,'viewPost']);

// Comment Section Route
Route::post('/comments',[CommentController::class,'store']);
Route::post('/delete-comment',[CommentController::class,'delete']);


// Start Admin Route
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){

  // Admin Dashboard
  Route::get('/dashboard',[DashboardController::class,'index']);

  // Category
  Route::get('/category',[CategoryController::class,'index']);
  Route::get('/add-category',[CategoryController::class,'create']);
  Route::post('/add-category',[CategoryController::class,'store']);
  Route::get('/edit-category/{category_id}',[CategoryController::class,'edit']);
  Route::put('/update-category/{category_id}',[CategoryController::class,'update']);
  //Route::get('/delete-category/{category_id}',[CategoryController::class,'delete']);
  Route::post('/delete-category',[CategoryController::class,'delete']);

  // Post
  Route::get('/posts',[PostController::class,'index']);
  Route::get('/add-post',[PostController::class,'create']);
  Route::post('/add-post',[PostController::class,'store']);
  Route::get('/edit-post/{post_id}',[PostController::class,'edit']);
  Route::put('/update-post/{post_id}',[PostController::class,'update']);
  Route::get('/delete-post/{post_id}',[PostController::class,'delete']);

  // Users
  Route::get('/users',[UserController::class,'index']);
  Route::get('/edit-user/{user_id}',[UserController::class,'edit']);
  Route::put('/update-user/{user_id}',[UserController::class,'update']);

  // Settings Route
  Route::get('/settings',[SettingController::class,'index']);
  Route::post('/settings',[SettingController::class,'savedata']);

});
