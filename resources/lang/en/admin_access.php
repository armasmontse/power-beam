<?php
return [
  'admin_menu'  =>  [
        'label' =>  'Menu',
        'index' =>  'Administrator',
  ],
    'index' => [
      'greeting'      => 'Hello :name',
      'label'         => 'Administrator',
      'instructions'  => 'Click on any item in the menu',
  ],
  'manuals' => [
      'label'		=>	'Manuals',
      'coming_soon' =>  'Coming soon',
      'admin_menu'  =>  [
            'label' =>  'Manuals',
            'index' =>  'Videos',
      ]
  ],
  'site_map' => [
    'label'		=>	'Routes',
    'index'		=>	'Routes administrator',
    'instructions'  =>  'Site routes',
    'admin_menu'	=>	[
      'label'		=>	'Routes',
      'index'		=>	'Routes administrator',
      'create'	=>	'Add route',
      'contents' => [
        'index' => 'Routes',
      ],
      'sections' => [
        'index' => 'Routes section administrator',
      ]
    ],
    'route_name' => [
      'label' => 'Route name'
    ],
  ],

];
