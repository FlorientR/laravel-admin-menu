<?php

namespace Florientr\AdminMenu\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

trait HasAdminMenu
{
	public function getAdminMenuTemplate($menu = null)
	{
		if ($menu != null && !empty($menu['template']))
			return $menu['template'];

		return config('admin_menu.template');
	}

	public function hasAdminMenu()
	{
		return $this->adminMenuConfig() != false;
	}

	public function printAdminMenu($params = [], $menuName = 'default')
	{
		if ($this->hasAdminMenu())
		{
			$menu = [];

			$menuConfig = $this->getAdminMenuConfig($menuName);

			foreach ($menuConfig as $actionName => $actionParams)
			{
				if (is_string($actionParams))
					$actionName = $actionParams;

				$config = config('admin_menu.actions.'.$actionName);

				if (!empty($config['permissions']) && !$this->canSeeAdminMenu($config['permissions']))
					continue;

				$menu[$actionName] = $config;

				if (empty($actionParams))
					$actionParams = [];

				if (!empty($params[$actionName]))
					$actionParams = array_merge($actionParams, $params[$actionName]);

				$menu[$actionName] = array_merge($menu[$actionName], $actionParams);

				if (empty($menu[$actionName]['route_params']))
					$menu[$actionName]['route_params'] = [];

				if (!empty($menu[$actionName]['route']) && Route::has($menu[$actionName]['route']))
					$menu[$actionName]['route'] = route($menu[$actionName]['route'], $menu[$actionName]['route_params']);
			}

			echo view($this->getAdminMenuTemplate($menu), compact('menu'));
		}
	}

	public function getAdminMenuView()
	{
		if ($this->hasAdminMenu())
		{
			return $this->getAdminMenuTemplate();
		}
	}

	public function canSeeAdminMenu($permissions)
	{
		if (Auth::check())
			return Auth::user()->can($permissions);

		return false;
	}

	public function getAdminMenuConfig($menuName)
	{
		$menu = $this->adminMenuConfig();

		if (!empty($menu[$menuName]))
			return $menu[$menuName];

		return [];
	}
}