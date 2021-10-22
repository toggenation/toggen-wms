<?php

$menus = [
    [
        'name' => 'Admin',
        'route' => 'admin',
        'active' => 1,
        'children' => [
            [
                'name' => "Menus",
                'route' => 'menus'
            ],
            [
                'name' => 'Printers',
                'active' => 1
            ],
            [
                'name' => 'Print Templates',
                'active' => 1
            ]
        ],

    ],
    [
        'name' => 'Warehouse',
        'route' => 'warehouse',
        'active' => 1,

        'children' => [
            [
                'name' => 'Dispatch',
                'route' => 'dispatch'
            ]
        ]
    ]
];
function recurse($menus, $prefix = '-', $store)
{
    foreach ($menus as $menuItem) {
        echo $menuItem['name'] . "\n";
        $store[] = $prefix . $menuItem['name'];
        if (isset($menuItem['children'])) {
            $store = recurse($menuItem['children'], $prefix . "-", $store);
        }
    }
    return $store;
}


echo print_r(recurse($menus, '+', []), true);
