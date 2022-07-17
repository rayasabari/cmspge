<?php

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\CollectionsController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\PageManagementController;
use App\Http\Controllers\Pages\HomeFrontController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return redirect('index');
// });

$menu = theme()->getMenu();
array_walk($menu, function ($val) {
    if (isset($val['path'])) {
        $route = Route::get($val['path'], [PagesController::class, 'index']);

        // Exclude documentation from auth middleware
        if (!Str::contains($val['path'], 'documentation')) {
            $route->middleware('auth');
        }
    }
});

Route::get('/index', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    // Pages Management
    Route::prefix('pages')->group(function () {
        Route::get('', [PageManagementController::class, 'indexView'])->name('pages.index');
        Route::get('getdata', [PageManagementController::class, 'getPagesData']);
        Route::post('submit', [PageManagementController::class, 'submitPage']);
        Route::delete('delete/{id}', [PageManagementController::class, 'delete']);

        Route::get('content-manager/{slug}', [PageManagementController::class, 'contentManagerView'])->name('pages.content-manager');
        Route::get('content-manager/getdata/{page:slug}', [PageManagementController::class, 'getContentData']);
        Route::post('content-manager/submit', [PageManagementController::class, 'submitContent']);
        Route::delete('content-manager/delete/{id}', [PageManagementController::class, 'deleteContent']);
    });

    // Collections Management
    Route::prefix('collections')->group(function () {
        // Services
        Route::get('services', [CollectionsController::class, 'servicesView'])->name('collections.services');
    });

    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
    });

    // Logs pages
    Route::prefix('log')->name('log.')->group(function () {
        Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
        Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
    });
});


// Documentations pages
Route::prefix('documentation')->group(function () {
    Route::get('getting-started/references', [ReferencesController::class, 'index']);
    Route::get('getting-started/changelog', [PagesController::class, 'index']);
});

Route::resource('users', UsersController::class);

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__ . '/auth.php';
