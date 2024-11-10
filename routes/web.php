<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertiesController;
use App\Models\Biens;
use App\Models\Types;
use App\Models\Ville;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $villes = Ville::all();
    $types = Types::all();
    return view('index', [
        'properties' => Biens::orderBy('created_at', 'desc')->where('accept', true)->paginate(6),
        'villes' => $villes,
        'types' => $types
    ]);
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [AdminController::class, 'contact'])->name('post.contact');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::patch('/dashbord-publishProperty/{id}', [AdminController::class, 'publishProperty'])->name('dashboard.publishProperty');
    Route::get('/dashboard-viewProperty/{id}', [AdminController::class, 'viewProperty'])->name('dashboard.viewProperty');
    Route::get('/dashboard-viewProperty', [AdminController::class, 'allProperties'])->name('dashboard.properties');
    Route::get('/dashboard-viewUser/{id}', [AdminController::class, 'viewUser'])->name('dashboard.viewUser');
    Route::get('/dashboard-setting', [AdminController::class, 'setting'])->name('dashboard.settings');
    Route::get('/dashboard-controller', [AdminController::class, 'controller'])->name('dashboar.controller');
    Route::get('/dashboard-controller_create', [AdminController::class, 'controller_create'])->name('dashboard.controller_create');
    Route::post('/dashboard-controller_create', [AdminController::class, 'create_controler'])->name('dashboard.create_controler');
    Route::get('/dashboard-contact', [AdminController::class, 'getContact'])->name('dashboard.contact');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name("profile");
    Route::post('/profile-becomeOwner', [ProfileController::class, 'becomeOwner'])->name('profile.becomeOwner');
    Route::get('/profile-notification', [ProfileController::class, 'getNotifications'])->name('profile.notification');
    Route::patch('/profile-notification/{id}', [ProfileController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('/profile-notification', [ProfileController::class, 'deleteNotification'])->name('notifications.delete');
    Route::get('/profile-properties', [ProfileController::class, 'ownerProperties'])->name('profile.properties');
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile-complete', [ProfileController::class, 'completeProfile'])->name('profile.complete');
    Route::patch('/profile-uploadAvatar', [ProfileController::class, 'upload_avatar'])->name('upload-avatar');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('property')->name('property.')->group(function () {
    Route::resource("xyz", PropertiesController::class);
});

Route::get('/property', [PropertiesController::class, 'searchProperties'])->name('search-property');
Route::post('/property-contact/{id}', [PropertiesController::class, 'contact'])->name('property.contact');


require __DIR__ . '/auth.php';
