<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAssistanceController;
use App\Http\Controllers\Admin\AdminTravelGuideController;
use App\Http\Controllers\Admin\AdminSurahController;
use App\Http\Controllers\Admin\AdminAyatController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminLiveProgramController;
use App\Http\Controllers\Admin\AdminNearByFacility;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\VolunteerRegistrationController;

Route::group(['middleware' => ['api', 'check.maintenance']], function () {

    // 🔐 Auth Routes
    Route::post('login', [UserController::class, 'login']);
    Route::post('login-with-phone', [UserController::class, 'loginWithPhone']);
    Route::post('social-login', [UserController::class, 'socialLogin']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('forgot-password', [UserController::class, 'forgotPassword']);
    Route::post('resend-code', [UserController::class, 'resendCode']);
    Route::post('reset-password', [UserController::class, 'resetPassword']);
    Route::post('refresh-token', [UserController::class, 'refreshToken']);
    Route::post('verification', [VerificationController::class, 'verify']);

    // 🧑 Authenticated Users (via Sanctum)
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::post('logout', [UserController::class, 'logout']);
        Route::post('delete-account', [UserController::class, 'deleteAccount']);


        Route::group(['middleware' => ['api.auth.check']], function () {
            Route::post('complete-profile', [UserController::class, 'completeProfile']);
            Route::post('profile', [UserController::class, 'getProfile']);
            Route::post('update-profile', [UserController::class, 'updateProfile']);
            Route::post('change-password', [UserController::class, 'changePassword']);

            Route::post('contact', [ApiController::class, 'contact']);

            Route::post('notifications', [ApiController::class, 'notifications']);
            Route::post('notifications/clear', [ApiController::class, 'notificationsClear']);

            Route::post('resend-verification-link', [VerificationController::class, 'resend']);
            Route::post('check-email-verified', [UserController::class, 'checkEmailVerified']);
            // ✅  API to get Travel Guide list using AdminTravelGuideController
            Route::get('travelguide', [AdminTravelGuideController::class, 'getAll'])->name('api.travelguide.getall');

            // ✅  API to get schedule  list using AdminScheduleController
            Route::get('schedule', [AdminScheduleController::class, 'getAll'])->name('api.schedule.getall');

            // ✅  API to get Live Program  list using AdminLiveProgramController
            Route::get('liveprogram', [AdminLiveProgramController::class, 'getAll'])->name('api.schedule.getall');

            // ✅  API to get Near By facilities Program  list using AdminNearByFacility
            Route::get('nearbyfacility', [AdminNearByFacility::class, 'getAll'])->name('api.schedule.getall');

            // ✅  API to get Live Program  list using AdminLiveProgramController

            Route::get('assistance', [AdminAssistanceController::class, 'getAll'])->name('api.assistance.getall');
            Route::post('assistance_add', [AdminAssistanceController::class, 'store_api'])->name('api.assistance.store_api');
            Route::get('surah', [AdminSurahController::class, 'getAll'])->name('api.surah.getall');

            Route::post('/get-ayat-by-surah', [AdminAyatController::class, 'getBySurah']);
        });
    });
    Route::post('/volunteer/register', [VolunteerRegistrationController::class, 'register']);
    // 🧾 View pages
    Route::get('view/terms-conditions', [HomeController::class, 'termsConditions'])->name('app.terms-conditions');
    Route::get('view/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('app.privacy-policy');
    Route::get('view/about', [HomeController::class, 'aboutUs'])->name('app.about-us');

    // 📄 Static API pages
    Route::get('terms-conditions', [ApiController::class, 'termsConditions']);
    Route::get('privacy-policy', [ApiController::class, 'privacyPolicy']);
    Route::get('about-us', [ApiController::class, 'aboutUs']);

    // 🌐 Other APIs
    Route::post('upload-profile-picture', [UserController::class, 'uploadProfilePicture']);
    Route::post('country', [ApiController::class, 'country']);
    Route::post('masters', [ApiController::class, 'masters']);
});
