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

		$this->publishes([
			__DIR__.'/css/' => resource_path('css').'/vendor/admin_menu/',
			__DIR__.'/js/' => resource_path('js').'/vendor/admin_menu/',
		], 'assets');
	}

	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__.'/../config/admin_menu.php',
			'admin_menu'
		);
	}
}