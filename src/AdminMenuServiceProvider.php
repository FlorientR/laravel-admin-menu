<?php

namespace Florientr\AdminMenu;

use Illuminate\Support\ServiceProvider;

class AdminMenuServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/admin_menu.php' => config_path().'/admin_menu.php',
		], 'config');

		$this->publishes([
			__DIR__.'/../views/' => resource_path('views').'/vendor/admin_menu/',
		], 'views');
	}

	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__.'/../config/admin_menu.php',
			'admin_menu'
		);
	}
}