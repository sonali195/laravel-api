<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCMSController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminAssistanceController;
use App\Http\Controllers\Admin\AdminTravelGuideController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminSurahController;
use App\Http\Controllers\Admin\AdminAyatController;
use App\Http\Controllers\Admin\AdminLiveProgramController;
use App\Http\Controllers\Admin\AdminNearByFacility;
use App\Http\Controllers\VolunteerRegistrationController;
use App\Http\Controllers\Admin\AdminFAQsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminEnquiryController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

Route::group(['middleware' => 'revalidate'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin-login');

    // Forgot Password
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    // Reset Password
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');

    Route::group(['middleware' => 'auth:admin', 'as' => 'admin.'], function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        // Change password
        Route::get('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
        Route::post('update-password', [ChangePasswordController::class, 'updatePassword'])->name('update.password');

        // User routes
        Route::resource('users', AdminUserController::class, ['names' => 'user']);
        Route::post('users/block', [AdminUserController::class, 'block'])->name('user.block');
        Route::post('users/exists', [AdminUserController::class, 'checkExists'])->name('user.exists');
        Route::get('user-login/{id}', [AdminUserController::class, 'userLogin'])->name('user-login');

        // Blogs
        Route::resource('blogs', AdminBlogController::class, ['names' => 'blogs']);
        Route::post('blogs/records', [AdminBlogController::class, 'getRecords'])->name('blogs.records');
        Route::post('blogs/exists', [AdminBlogController::class, 'exists'])->name('blogs.exists');

        Route::resource('travelguide', AdminTravelGuideController::class, ['names' => 'travelguide']);
        Route::post('travelguide/records', [AdminTravelGuideController::class, 'getRecords'])->name('travelguide.records');
        Route::post('travelguide/exists', [AdminTravelGuideController::class, 'exists'])->name('travelguide.exists');

        // Travel Guide
        Route::resource('travelguide', AdminTravelGuideController::class, ['names' => 'travelguide']);
        Route::post('travelguide/records', [AdminTravelGuideController::class, 'getRecords'])->name('travelguide.records');
        Route::post('travelguide/exists', [AdminTravelGuideController::class, 'exists'])->name('travelguide.exists');

        // Schedule
        Route::resource('schedule', AdminScheduleController::class, ['names' => 'schedule']);
        Route::post('schedule/records', [AdminScheduleController::class, 'getRecords'])->name('schedule.records');
        Route::post('schedule/exists', [AdminScheduleController::class, 'exists'])->name('schedule.exists');

        // Live Program
        Route::resource('liveprogram', AdminLiveProgramController::class, ['names' => 'liveprogram']);
        Route::post('liveprogram/records', [AdminLiveProgramController::class, 'getRecords'])->name('liveprogram.records');
        Route::post('liveprogram/exists', [AdminLiveProgramController::class, 'exists'])->name('liveprogram.exists');

        // Near By Facilities Program
        Route::resource('nearbyfacility', AdminNearByFacility::class, ['names' => 'nearbyfacility']);
        Route::post('nearbyfacility/records', [AdminNearByFacility::class, 'getRecords'])->name('nearbyfacility.records');
        Route::post('nearbyfacility/exists', [AdminNearByFacility::class, 'exists'])->name('nearbyfacility.exists');

        Route::resource('surah', AdminSurahController::class, ['names' => 'surah']);
        Route::post('surah/records', [AdminSurahController::class, 'getRecords'])->name('surah.records');
        Route::post('surah/exists', [AdminSurahController::class, 'exists'])->name('surah.exists');

        Route::resource('ayat', AdminAyatController::class, ['names' => 'ayat']);
        Route::post('ayat/records', [AdminAyatController::class, 'getRecords'])->name('ayat.records');
        Route::post('ayat/exists', [AdminAyatController::class, 'exists'])->name('ayat.exists');


        // FAQs
        Route::resource('faqs', AdminFAQsController::class, ['names' => 'faqs']);
        Route::post('faqs/records', [AdminFAQsController::class, 'getRecords'])->name('faqs.records');
        Route::post('faqs/exists', [AdminFAQsController::class, 'exists'])->name('faqs.exists');


        // assistance
        Route::resource('assistance', AdminAssistanceController::class, ['names' => 'assistance']);
        Route::post('assistance/records', [AdminAssistanceController::class, 'getRecords'])->name('assistance.records');
        Route::post('assistance/exists', [AdminAssistanceController::class, 'exists'])->name('assistance.exists');


        Route::resource('volunteerlist', VolunteerRegistrationController::class, ['names' => 'volunteerlist']);
        Route::post('volunteerlist/records', [VolunteerRegistrationController::class, 'getRecords'])->name('volunteerlist.records');
        Route::post('volunteerlist/exists', [VolunteerRegistrationController::class, 'exists'])->name('volunteerlist.exists');
        // Category
        Route::resource('categories', AdminCategoryController::class, ['names' => 'category']);
        Route::post('categories/records', [AdminCategoryController::class, 'index'])->name('category.records');
        Route::post('categories/exists', [AdminCategoryController::class, 'checkExists'])->name('category.exists');

        // Enquiry routes
        Route::resource('enquiry', AdminEnquiryController::class, ['names' => 'enquiry'])->except(['show']);

        // Email
        Route::resource('emails', AdminEmailController::class, ['names' => 'email'])->except(['show']);
        Route::post('emails/records', [AdminEmailController::class, 'index'])->name('email.records');

        // CMS
        Route::any('cms-pages', [AdminCMSController::class, 'index'])->name('cms.index');
        Route::get('cms-pages/edit-page/{id}', [AdminCMSController::class, 'edit'])->name('cms.edit');
        Route::post('cms-pages/edit-page', [AdminCMSController::class, 'update'])->name('cms.update');
        Route::post('cms-pages/image-upload', [AdminCMSController::class, 'uploadImage'])->name('cms.upload');

        // Settings
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('save-settings', [AdminController::class, 'saveSettings'])->name('save.settings');
        Route::get('edit/privacy-policy', [AdminController::class, 'editPageContent'])->name('privacy-policy');
        Route::get('edit/terms-conditions', [AdminController::class, 'editPageContent'])->name('terms-&-conditions');
        Route::get('edit/about-us', [AdminController::class, 'editPageContent'])->name('about-us');
        Route::post('save-page-content', [AdminController::class, 'savePageContent'])->name('save.pageContent');
    });
});
