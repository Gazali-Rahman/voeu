<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\WebhookController;
use App\Livewire\Admin\AdminOrder;
use App\Livewire\Admin\Createinvitation;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Manageuser;
use App\Livewire\Admin\RoleManagement;
use App\Livewire\Admin\ManageCatalog;
use App\Livewire\Admin\Manageorder;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Checkout;
use App\Livewire\Home;
use App\Livewire\Invitations\Home as InvitationsHome;
use App\Livewire\Invitations\Show;
use App\Livewire\Payment;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/checkout/{slug}', Checkout::class)->name('checkout');
    Route::get('/payment/{external_id}', Payment::class)->name('payment');
    Route::get('/order/success/{external_id}', \App\Livewire\SuccessPage::class)->name('order.success');
    Route::get('/my-orders', \App\Livewire\MyOrders::class)->name('my-orders');
    Route::get('/invitation/{slug}/dashboard', \App\Livewire\InvitationDashboard::class)
        ->name('invitation.dashboard');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');

    // Socialite Routes
    Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/users', Manageuser::class)->name('admin.users');
    Route::get('/roles', RoleManagement::class)->name('admin.roles');
    Route::get('/catalogs', ManageCatalog::class)->name('admin.catalogs');
    Route::get('/orders', Manageorder::class)->name('admin.orders');
    Route::get('/cashflow', \App\Livewire\Admin\Cashflow::class)->name('admin.cashflow');
    Route::get('/promos', \App\Livewire\Admin\Managepromo::class)->name('admin.promos');
    Route::get('/invitation/create/{order_id}', Createinvitation::class)
        ->name('invitation.create');
    Route::get('/invitations', \App\Livewire\Admin\ManageInvitation::class)->name('admin.invitations');
});
Route::post('/webhook/xendit', [WebhookController::class, 'handleXendit']);
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

// Invitation Routes
Route::get('/v/{slug}', Show::class)->name('invitation.v');
// Route ini akan menangani SEMUA tema secara otomatis
Route::get('/v/{slug}/home', InvitationsHome::class)->name('invitation.home');
