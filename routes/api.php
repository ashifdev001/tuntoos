<?php

use App\Http\Controllers\API\AchievementController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CustomerSayController;
use App\Http\Controllers\API\DropdownItemController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\FlavorController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\GeneralSettingController;
use App\Http\Controllers\API\JobApplicationController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SatisfactionGuaranteedController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\ServiceCategoryController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SocialLinkController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TrackingScriptsController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\WhyChooseUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Register & Auth
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('reset-password', [RegisterController::class, 'resetPassword']);

// Public general settings
Route::get('settings/general', [GeneralSettingController::class, 'generalSettingsList']);
Route::post('enquiries', [UsersController::class, 'saveEnq']);

// Public GET resource routes
Route::apiResource('blogs', BlogController::class)->only(['index', 'show']);
Route::apiResource('events', EventController::class)->only(['index', 'show']);
Route::apiResource('service-categories', ServiceCategoryController::class)->only(['index', 'show']);
Route::apiResource('banners', BannerController::class)->only(['index', 'show']);
Route::apiResource('why-choose-us', WhyChooseUsController::class)->only(['index', 'show']);
Route::apiResource('customer-say', CustomerSayController::class)->only(['index', 'show']);
Route::apiResource('achievements', AchievementController::class)->only(['index', 'show']);
Route::apiResource('brands', BrandController::class)->only(['index', 'show']);
Route::apiResource('satisfaction-guaranteed', SatisfactionGuaranteedController::class)->only(['index', 'show']);
Route::apiResource('jobs', JobController::class)->only(['index', 'show']);
Route::apiResource('social-links', SocialLinkController::class)->only(['index', 'show']);
Route::apiResource('services', ServiceController::class)->only(['index', 'show']);
Route::apiResource('tracking-scripts', TrackingScriptsController::class)->only(['index', 'show']);
Route::apiResource('galleries', GalleryController::class)->only(['index', 'show']);
Route::post('appointments', [AppointmentController::class, 'store']);
Route::post('job-applications', [JobApplicationController::class, 'store']);

// Clear cache route
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'cache cleared!!';
});

// Protected routes
Route::group(['middleware' => 'auth:api'], function () {

    // General settings save
    Route::group(['prefix' => 'settings'], function () {
        Route::post('save', [GeneralSettingController::class, 'saveSettings']);
    });

    // User actions
    Route::get('user-profile', [UsersController::class, 'userProfile']);
    Route::post('profile-image-update', [UsersController::class, 'profileimgUpdate']);
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::post('password-update', [RegisterController::class, 'passwordUpdate']);
    Route::post('profile-update', [RegisterController::class, 'profileUpdate']);

    // Private resource routes (create, update, delete)
    Route::apiResource('blogs', BlogController::class)->except(['index', 'show']);
    Route::apiResource('events', EventController::class)->except(['index', 'show']);
    Route::apiResource('service-categories', ServiceCategoryController::class)->except(['index', 'show']);
    Route::apiResource('banners', BannerController::class)->except(['index', 'show']);
    Route::apiResource('why-choose-us', WhyChooseUsController::class)->except(['index', 'show']);
    Route::apiResource('customer-say', CustomerSayController::class)->except(['index', 'show']);
    Route::apiResource('achievements', AchievementController::class)->except(['index', 'show']);
    Route::apiResource('brands', BrandController::class)->except(['index', 'show']);
    Route::apiResource('satisfaction-guaranteed', SatisfactionGuaranteedController::class)->except(['index', 'show']);
    Route::apiResource('jobs', JobController::class)->except(['index', 'show']);
    Route::apiResource('social-links', SocialLinkController::class)->except(['index', 'show']);
    Route::apiResource('services', ServiceController::class)->except(['index', 'show']);
    Route::apiResource('appointments', AppointmentController::class)->except(['store']);
    Route::apiResource('tracking-scripts', TrackingScriptsController::class)->except(['index', 'show']);
    Route::apiResource('galleries', GalleryController::class)->except(['index', 'show']);
    Route::apiResource('job-applications', JobApplicationController::class)->except(['store']);
    Route::apiResource('teams', TeamController::class);
    Route::apiResource('flavors', FlavorController::class);
    Route::apiResource('videos', VideoController::class);
    Route::apiResource('dropdown-items', DropdownItemController::class);
    

    // Enquiries (admin only)
    Route::get('enquiries', [UsersController::class, 'enquiries']);
    Route::delete('enquiries/delete/{enquiry}', [UsersController::class, 'enquiryDelete']);
});
