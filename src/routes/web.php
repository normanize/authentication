<?php

Route::get('forgot-password', function () {
  return view('auth::mails.resetPassword');
})->name('password.reset');