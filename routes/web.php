<?php

use App\Classes\ImageuploadHelper;
use App\Models\Blog;
use App\Models\Flavor;
use App\Models\GeneralSetting;
use App\Models\Team;
use App\Models\Video;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

// Frontend Routes
Route::get('/', function () {
    $dropdownItems = \App\Models\DropdownItem::all();
    return view('frontend.pages.index', compact('dropdownItems'));
})->name('home');

Route::get('/franchise', function () {
     $settings = GeneralSetting::whereIn('key', [
        'franchise_image',
        'franchise_model',
        'funtoos_image',
        'funtoos_description',
        'funtoos_image_1',
        'funtoos_image_2',
        'funtoos_promise',
        'funtoos_promise_btn_text_1',
        'funtoos_promise_btn_bellow_text_1',
         'funtoos_promise_btn_text_2',
        'funtoos_promise_btn_bellow_text_2'
    ])->pluck('value', 'key');
    $settings = [
        'franchise_image_url' => ImageuploadHelper::getUploadedFileUrl($settings['franchise_image']),
        'franchise_model' => $settings['franchise_model'],
        'funtoos_description' => $settings['funtoos_description'],
        'funtoos_promise' => $settings['funtoos_promise'],
        'funtoos_image_1_url' => ImageuploadHelper::getUploadedFileUrl($settings['funtoos_image_1']),
        'funtoos_image_2_url' => ImageuploadHelper::getUploadedFileUrl($settings['funtoos_image_2']),
        'funtoos_image_url' => ImageuploadHelper::getUploadedFileUrl($settings['funtoos_image']),
        'funtoos_promise_btn_text_1' => $settings['funtoos_promise_btn_text_1'],
        'funtoos_promise_btn_bellow_text_1' => $settings['funtoos_promise_btn_bellow_text_1'],
        'funtoos_promise_btn_text_2' => $settings['funtoos_promise_btn_text_2'],
        'funtoos_promise_btn_bellow_text_2' => $settings['funtoos_promise_btn_bellow_text_2'],
    ];
    return view('frontend.pages.franchise',compact('settings'));
})->name('franchise');

Route::get('/distributor', function () {
    $settings = GeneralSetting::whereIn('key', [
        'distributor_image',
        'distributor_description',
        'distributor_more_content',
    ])->pluck('value', 'key');
    $settings = [
        'distributor_image_url' => ImageuploadHelper::getUploadedFileUrl($settings['distributor_image']),
        'distributor_description' => $settings['distributor_description'],
        'distributor_more_content' => $settings['distributor_more_content'],
    ];
    return view('frontend.pages.distributor',compact('settings'));
})->name('distributor');

Route::get('/flavor', function () {
    $flavors = Flavor::orderBy('id', 'desc')->paginate(9);
    return view('frontend.pages.flavor', ['flavors' => $flavors]);
})->name('flavor');

// About Routes
Route::get('/about', function () {
    $settings = GeneralSetting::whereIn('key', [
        'about_image',
        'about_description',
    ])->pluck('value', 'key');
    $teams = Team::all();
    $settings = [
        'about_image_url' => ImageuploadHelper::getUploadedFileUrl($settings['about_image']),
        'about_description' => $settings['about_description'],
    ];
    return view('frontend.pages.about-us', compact('settings', 'teams'));
})->name('about');

Route::get('/about/team', function () {
    return view('frontend.pages.team');
})->name('about.team');

// Media Routes
Route::get('/gallery', function () {
    return view('frontend.pages.galleries');
})->name('gallery');

Route::get('/video', function () {
    $videos = Video::orderBy('id', 'desc')->paginate(9);
    return view('frontend.pages.videos',compact('videos'));
})->name('video');

// Contact Route
Route::get('/contact', function () {
    $settings = GeneralSetting::whereIn('key', [
        'contact_address',
        'contact_phone',
        'contact_email',
        'contact_open_hrs',
        'map_link',
    ])->pluck('value', 'key');

    return view('frontend.pages.contact-us', compact('settings'));
})->name('contact');

Route::get('thank-you', function () {
    return view('frontend.pages.thankyou');
})->name('thank-you');

// Admin Routes
Route::group(['prefix' => '/admin'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    // Auth routes
    Route::get('login', function () {
        return view('auth.login');
    });

    // Forgot password
    Route::get('/forgot-password', function () {
        return view('auth.forgot_password');
    });

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');
    // Manage profile
    Route::get('/manage-profile', function () {
        return view('admin.user.manageProfile');
    });
    Route::view('/enquiries', 'admin.enquiries.index')->name('admin-enquiries');

    Route::get('/general-settings', function () {
        return view('admin.generalSettings.generalSettings');
    })->name('general-settings');

    Route::get('/banners', function () {
        return view('admin.banners.index');
    })->name('banners');
    Route::get('/banners/create', function () {
        return view('admin.banners.manage');
    })->name('create-banner');
    Route::get('/banners/edit/{id}', function ($id) {
        return view('admin.banners.manage', ['id' => $id]);
    });

    Route::get('/brands', function () {
        return view('admin.brands.index');
    })->name('brands');
    Route::get('/brands/create', function () {
        return view('admin.brands.manage');
    })->name('create-brands');
    Route::get('/brands/edit/{id}', function ($id) {
        return view('admin.brands.manage', ['id' => $id]);
    });

    Route::get('/testimonials', function () {
        return view('admin.testimonials.index');
    })->name('testimonials');
    Route::get('/testimonials/create', function () {
        return view('admin.testimonials.manage');
    })->name('create-testimonials');
    Route::get('/testimonials/edit/{id}', function ($id) {
        return view('admin.testimonials.manage', ['id' => $id]);
    });

    Route::get('/flavors', function () {
        return view('admin.flavors.index');
    })->name('admin.flavors');
    Route::get('/flavors/create', function () {
        return view('admin.flavors.manage');
    })->name('admin-flavor.create');
    Route::get('/flavors/edit/{id}', function ($id) {
        return view('admin.flavors.manage', ['id' => $id]);
    });

     Route::get('/manage-home', function () {
        return view('admin.manage-home.index');
    })->name('admin.manage.home');

    Route::get('/teams', function () {
        return view('admin.teams.index');
    })->name('admin.teams');
    Route::get('/teams/create', function () {
        return view('admin.teams.manage');
    })->name('admin-team.create');
    Route::get('/teams/edit/{id}', function ($id) {
        return view('admin.teams.manage', ['id' => $id]);
    });

    Route::get('/franchise', function () {
        return view('admin.franchise.index');
    })->name('admin.franchise');
    Route::get('/manage-distributor', function () {
        return view('admin.distributor.index');
    })->name('admin.distributor');

    Route::get('/about-us', function () {
        return view('admin.about.index');
    })->name('admin.about');
    Route::get('/manage-contact', function () {
        return view('admin.contact.index');
    })->name('admin.contact');

    Route::get('/galleries', function () {
        return view('admin.galleries.index');
    })->name('admin.galleries');
    Route::get('/galleries/create', function () {
        return view('admin.galleries.manage');
    })->name('add.images');
    Route::get('/galleries/edit/{id}', function ($id = null) {
        return view('admin.galleries.manage', ['id' => $id]);
    })->name('edit.images');

    Route::get('/videos', function () {
        return view('admin.videos.index');
    })->name('admin.videos');
    Route::get('/videos/create', function () {
        return view('admin.videos.manage');
    })->name('add.video');
    Route::get('/videos/edit/{id}', function ($id = null) {
        return view('admin.videos.manage', ['id' => $id]);
    })->name('edit.video');
     Route::get('/dropdown-items', function () {
        return view('admin.dropdown-items.index');
    })->name('admin.dropdown-items');
});

