<?php
Route::get('/', function () { return view('welcome'); });
// Route::get('/', function () { return redirect('/admin/home'); });

Route::group(['prefix' => '', 'as' => 'auth.'], function () {
    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register')->name('register');
    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login')->name('login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    // Change Password Routes...
    $this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('change_password');
    $this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('change_password');

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');


});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

});
