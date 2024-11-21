<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SettingController;
use App\Http\Livewire\GalleryShow;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');

// Move specific page routes above resource declaration
//Route::get('/pages/home', [PageController::class, 'editHome'])->name('pages.home');
//Route::get('/pages/rooms', [PageController::class, 'editRooms'])->name('pages.rooms');
//Route::get('/pages/amenities', [PageController::class, 'editAmenities'])->name('pages.amenities');
//Route::get('/pages/activities', [PageController::class, 'editActivities'])->name('pages.activities');
//Route::get('/pages/contact', [PageController::class, 'editContact'])->name('pages.contact');


// Resource routes
Route::resource('site-pages', PageController::class)->names([
    'index' => 'site-pages.index',
    'create' => 'site-pages.create',
    'store' => 'site-pages.store',
    'show' => 'site-pages.show',
    'edit' => 'site-pages.edit',
    'update' => 'site-pages.update',
    'destroy' => 'site-pages.destroy',
]);

//gallery controller
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::post('/galleries/store', [GalleryController::class, 'store'])->name('galleries.store');
Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');

Route::resource('sections', SectionsController::class);
Route::post('/sections/{section}/link-gallery', [SectionsController::class, 'linkGallery']);


Route::resource('media', MediaController::class);
Route::resource('bookings', BookingController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('settings', SettingController::class);

// Define resource routes for ImageController
Route::resource('images', ImageController::class);

// Additional routes for specific actions
Route::patch('images/{image}/replace', [ImageController::class, 'replace'])->name('images.replace');
Route::patch('images/{image}/change-section', [ImageController::class, 'changeSection'])->name('images.change-section');
Route::post('images/{image}/add-to-gallery', [ImageController::class, 'addToGallery'])->name('images.add-to-gallery');
Route::post('images/upload', [ImageController::class, 'uploadCsv'])->name('images.upload');
Route::patch('/images/{image}/replace', [ImageController::class, 'replace']);
Route::patch('/images/{image}/move', [ImageController::class, 'addToGallery']);

Route::get('/docs', function () {
    return view('docs');
})->name('docs');
