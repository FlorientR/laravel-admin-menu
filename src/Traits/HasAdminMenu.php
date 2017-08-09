<?php

namespace Florientr\AdminMenu\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

trait HasAdminMenu
{
	public function getAdminMenuTemplate($menu = null)
	{
		if ($menu != null && !empty($menu['tempalte']))
			return $menu['tempalte'];

		return config('admin_menu.template');
	}

	public function getAdminMenuInclude($menu = null)
	{
		if ($menu != null && !empty($menu['include']))
			return $menu['include'];

		return config('admin_menu.include');
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
				{
					continue;
				}

				$menu[$actionName] = config('admin_menu.actions.'.$actionName);

				if (empty($actionParams))
					$actionParams = [];

				$menu[$actionName]['params'] = $actionParams;

				if (!empty($menu[$actionName]['route']) && Route::has($menu[$actionName]['route']))
					$menu[$actionName]['route'] = route($menu[$actionName]['route'], $actionParams);
			}

			if (!session('adminmenu_included'))
			{
				echo view($this->getAdminMenuInclude($menu));
				session(['adminmenu_included' => true]);
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
		elseif (!empty($menu['default']))
			return $menu['default'];

		return [];
	}
}