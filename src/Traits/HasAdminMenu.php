<?php

namespace Florientr\AdminMenu\Traits;

trait HasAdminMenu
{
	public function getAdminMenu()
	{
		if ($this->adminMenuConfig != null)
		{
			return views(config('admin_menu.tempalte'));
		}
	}
}