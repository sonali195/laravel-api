<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminLiveProgramController;
use App\Http\Controllers\Admin\AdminAyatController;
use App\Http\Controllers\Admin\AdminAssistanceController;
use App\Http\Controllers\Admin\AdminNearByFacility;
use App\Http\Controllers\Admin\AdminSurahController;
use App\Http\Controllers\Admin\AdminTravelGuideController;
use App\Http\Controllers\Auth\VerificationController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

Route::get('logs', [LogViewerController::class, 'index']);

Route::group(['middleware' => 'revalidate'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // Login, Register, Forgot Password, Reset Password
    Auth::routes(['verify' => true]);

    Route::get('cms-home', [HomeController::class, 'cmsHome'])->name('cms.home');
    Route::get('redirect-user-login/{id}', [AdminUserController::class, 'userLoginRedirect'])->name('redirect.user-login');

    // If you want to set new password while creating user from admin side
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('verified/{user}', [VerificationController::class, 'showVerifiedPage'])->name('verify');
    Route::post('verified', [VerificationController::class, 'verified'])->name('verified');

    Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about-us');
    Route::get('terms-conditions', [HomeController::class, 'termsConditions'])->name('terms-conditions');
    Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

    Route::get('travel-guide', [AdminTravelGuideController::class, 'web'])->name('travelguide');
    Route::get('/travelguide/fetch/{type}', [AdminTravelGuideController::class, 'fetchByType'])->name('travelguide.fetch');

    Route::get('schedule', [AdminScheduleController::class, 'showSchedule'])->name('schedule');
    Route::get('liveprogram', [AdminLiveProgramController::class, 'showLiveProgram'])->name('liveprogram');
    Route::get('nearbyfacility', [AdminNearByFacility::class, 'shownearbyfacility'])->name('nearbyfacility');
    Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('enquiry', [HomeController::class, 'enquiry'])->name('contact.enquiry');
    Route::get('blog/{slug?}', [HomeController::class, 'viewBlogs'])->name('blogs');
    Route::get('faqs', [HomeController::class, 'faqs'])->name('faqs');

    Route::get('quran', [AdminSurahController::class, 'showquran'])->name('quran');
    Route::get('/assistance_web', [AdminAssistanceController::class, 'showassistance'])->name('assistance_web');
    Route::get('/assistance', [AdminAssistanceController::class, 'index'])->name('assistance.index');
    Route::post('/assistance/first-aid', [AdminAssistanceController::class, 'store_web'])->name('assistance.first_aid');
    Route::post('exists-user', [HomeController::class, 'checkExists'])->name('user.exists');
    Route::post('upload-files', [HomeController::class, 'uploadFiles'])->name('upload-files');
    Route::post('upload-images', [HomeController::class, 'uploadCKeditorImage'])->name('upload-ck-editor-images');
    Route::post('upload-crop-image', [HomeController::class, 'uploadCropImage'])->name('upload-crop-image');

    // User URLs
    Route::group(['middleware' => ['auth']], function () {
        Route::get('home', [HomeController::class, 'dashboard'])->name('home');

        // Profile
        Route::get('complete-profile', [HomeController::class, 'profile'])->name('user.complete.profile');
        Route::post('save-profile', [HomeController::class, 'saveProfile'])->name('save.profile');

        Route::group(['middleware' => ['user']], function () {
            // Profile
            Route::get('profile', [HomeController::class, 'profile'])->name('user.profile');
            // Route::post('save-profile', [HomeController::class, 'saveProfile'])->name('save.profile');

            // Change password
            Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password');
            Route::post('update-password', [HomeController::class, 'updatePassword'])->name('user.update.password');

            Route::post('notifications', [HomeController::class, 'notifications'])->name('user.notifications');
        });
    });
});
