# laravel-admin-menu
Manage actions on models

`composer require florientr/laravel-admin-menu`

`Florientr\AdminMenu\AdminMenuServiceProvider::class,`

`php artisan vendor:publish --provider=Florientr\AdminMenu\AdminMenuServiceProvider --tag=config`

`php artisan vendor:publish --provider=Florientr\AdminMenu\AdminMenuServiceProvider --tag=views`

`php artisan vendor:publish --provider=Florientr\AdminMenu\AdminMenuServiceProvider --tag=assets`

`mix.copy('resources/css/vendor/admin_menu/admin_menu.css', 'public/css/admin_menu.css');`
	
`mix.copy('resources/js/vendor/admin_menu/admin_menu.js', 'public/js/admin_menu.js');`

`gulp`

```
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/admin_menu.css') }}">
@endpush
```

```
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/admin_menu.js') }}"></script>
@endpush
```

```
<?php

return [
	'template' => 'vendor.admin_menu.default',

	'actions' => [
		'edit_item' => [
			'label' => 'Item',
			'title' => 'Edit item',
			'permissions' => 'edit item',
			'icon' => 'fa fa-pencil',
			'route' => 'item.edit',
		],
		'delete_item' => [
			'label' => 'Delete',
			'title' => 'Delete item',
			'permissions' => 'delete item',
			'icon' => 'fa fa-remove',
			'route' => 'item.destroy',
			'type' => 'delete',
		],
		'js_exemple' => [
			'label' => 'Test JS',
			'title' => 'Test du javascript',
			'icon' => 'fa fa-group',
			'attributes' => [
				'data-test' => 'my_value'
			]
		]
	]
];
```

```
use Florientr\AdminMenu\Traits\HasAdminMenu;

use HasAdminMenu;

public function adminMenuConfig()
{
	return [
		'default' => [
			'edit_item' => [
				'route_params' => [
					'item' => $this->id,
				 ]
			],
			'delete_item' => [
				'route_params' => [
				 	'item' => $this->id,
				 ]
			]
		]
	];
}
```