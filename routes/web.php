<?php

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

Route::get('/', 'AppController@index')->name('landing');
Route::get('/lapang/{id}/{tanggal}', 'AppController@getJadwal')->name('jadwal_lapang');
Route::get('/lapang', 'AppController@lapang')->name('lapang');
Route::get('/lapang/{id}', 'AppController@showLapang')->name('detail_lapang');
Route::get('/api/check-booking',  'Api\BookingController@checkVerify' )->name('api.booking-check');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/api/booking/{id}',  'Api\BookingController@getByUser' )->name('api.booking');
    Route::post('/booking', 'BookingController@store' )->name('store.booking');
    Route::post('/booking/confirm/{id}', 'BookingController@confirm' )->name('confirm.booking');
    Route::get('/profile', 'ProfileController@index' )->name('index.profile');
    Route::put('/profile/{id}/edit', 'ProfileController@update' )->name('index.profile');
    Route::get('/booking', 'BookingController@index' )->name('index.booking');
    Route::get('/booking/success/{id}', 'BookingController@success' )->name('success.booking');
    Route::get('/booking/cancel/{id}', 'BookingController@cancel' )->name('cancel.booking');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {

// Login Routes...
    Route::get('login', ['as' => 'admin.login', 'uses' => 'AdminAuth\LoginController@showLoginForm']);
    Route::post('login', ['uses' => 'AdminAuth\LoginController@login']);
    Route::post('logout', ['as' => 'admin.logout', 'uses' => 'AdminAuth\LoginController@logout']);

// Registration Routes...
    Route::get('register', ['as' => 'admin.register', 'uses' => 'AdminAuth\RegisterController@showRegistrationForm']);
    Route::post('register', ['uses' => 'AdminAuth\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'admin.password.reset', 'uses' => 'AdminAuth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'admin.password.email', 'uses' => 'AdminAuth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'admin.password.reset.token', 'uses' => 'AdminAuth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['uses' => 'AdminAuth\ResetPasswordController@reset']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('api/booking', 'Api\BookingController@index')->name('api.booking');
    Route::get('dashboard', 'AdminController@index')->name('admin.home');
    Route::get('booking', 'Admin\ManageBookingController@index')->name('admin.booking');
    Route::get('laporan', 'Admin\ManageBookingController@laporan')->name('laporan.booking');
    Route::get('show/laporan', 'Admin\ManageBookingController@showLaporan')->name('showlaporan.booking');
    Route::put('booking/{id}/cancel', 'Admin\ManageBookingController@cancel')->name('admin.cancel-book');
    Route::put('booking/{id}/verify', 'Admin\ManageBookingController@verify')->name('admin.verify-book');
    Route::resources([
        'lapang' => 'Admin\LapangController',
        'user' => 'Admin\ManageUserController',
    ]);
    Route::put('user/{id}/ban', ['uses' => 'Admin\ManageUserController@ban']);
    Route::put('user/{id}/unbanned', ['uses' => 'Admin\ManageUserController@unban']);
});


Route::get('test', function () {
    try {

        // $options = array(
        //   'cluster' => 'ap1',
        //   'encrypted' => true
        // );
        // $pusher = new Pusher\Pusher(
        //   '67b689f1b7f71c36e781',
        //   '092db3879e50b1d5219e',
        //   '533609',
        //   $options
        // );

        // $data['message'] = 'hello world';
        // $pusher->trigger('new-order', 'new-order-notif', $data);
        event(new App\Events\NewOrder('rizal'));
        return "Event has been sent!";
    } catch (Exception $e) {
        return $e->getMessage();
    }
});
