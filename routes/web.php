<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DownloadImageController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSettingController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
});
Route::get('/', [ExploreController::class, 'explore'])->name('explore');
Route::middleware(['auth'])->group(function () {
    Route::get('/search', [ExploreController::class, 'search'])->name('search');
    Route::post('/download/image/{image}', [DownloadImageController::class, 'download'])->name('download.image');
    Route::post('/image/{image}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/image/{comment}/comment', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('/image/{image}/like', [GalleryLikeController::class, 'like'])->name('like');
    Route::post('/image/{image}/unlike', [GalleryLikeController::class, 'unlike'])->name('unlike');
    Route::get('/profile/{user:slug}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user:slug}/image/{image}', [ProfileController::class, 'profileImage'])->name('profile.image');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/images', GalleryController::class)->except(['index','create','edit']);
    Route::resource('/setting/user', UserSettingController::class)->except(['index','create','store']);
    Route::get('/setting/account-management/{user:slug}', [ProfileController::class, 'edit'])->name('account.management.edit');
    Route::put('/setting/account-management/{user:slug}', [ProfileController::class, 'update'])->name('account.management.update');
    Route::middleware(['can:auth.admin'])->group(function () {
        Route::get('/dashboard/traffic/{year}', [AdminController::class, 'traffic'])->name('dashboard.traffic');
        Route::get('/dashboard/data-user', [AdminController::class, 'user'])->name('dashboard.user');
        Route::post('/dashboard/data-user', [AdminController::class, 'userStore'])->name('dashboard.user.store');
        Route::get('/dashboard/data-image', [AdminController::class, 'image'])->name('dashboard.image');
        Route::put('/dashboard/data-image/{image}', [AdminController::class, 'changeStatus'])->name('dashboard.image.status');
    });
});
