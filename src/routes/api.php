<?php

Route::post('login', 'AuthController@login')->name('login');
Route::post('register', 'RegistrationController@register')->name('register');

Route::post('forgot-password', 'ForgotPasswordController@forgotPassword')->name('forgotPassword');
Route::post('password/reset', 'ForgotPasswordController@resetPassword');

Route::group(['middleware' => ['auth:api']], function() {

  Route::post('logout', 'AuthController@logout')->name('logout');

});