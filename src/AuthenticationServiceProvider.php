<?php

namespace Normanize\Authentication;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider 
{

  public function boot()
  {
    Route::middleware('api')
      ->prefix('api')
      ->namespace('Normanize\Authentication\Controllers')
      ->group(function() {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
      });
      
    $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    $this->loadViewsFrom(__DIR__.'/views', 'auth');
  }

  public function register()
  {

  }

}