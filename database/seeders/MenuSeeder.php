<?php

namespace Database\Seeders;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();
        $menus = $this->getMenuData();

        foreach ($menus as $menu) {

            $node = Menu::create(
                $menu
            );
        }
    }


    protected function getMenuData()
    {

        return [
            [
                'name' => 'Product data',
                'route_url' => 'data',
                'icon' => 'faListAlt',
                'active' => 1,
                'children' => [

                    [
                        'name' => "Create",
                        'active' => 0,
                        'route_url' => 'admin.items.create',
                        'icon' => 'faPlus'
                    ]
                ]

            ],
            [
                'name' => 'Admin',
                'route_url' => 'admin',
                'icon' => 'faCog',
                'active' => 1,
                'children' => [
                    [
                        'name' => "Menus",
                        'route_url' => 'admin.menus',
                        'icon' => 'faListAlt'
                    ],
                    [
                        'name' => 'Settings',
                        'route_url' => 'admin.settings',
                        'active' => 1,
                        'icon' => 'faCogs'
                    ],
                    [
                        'name' => 'Printers',
                        'route_url' => 'admin.printers',
                        'active' => 1,
                        'icon' => 'printer'
                    ],
                    [
                        'name' => 'Print Templates',
                        'route_url' => 'admin.print-templates',
                        'active' => 1,
                        'icon' => 'faFileAlt'
                    ],
                    [
                        'name' => 'Barcode',
                        'title' => 'Check digit calculator',
                        'route_url' => 'barcode',
                        'active' => 1,
                        'icon' => 'faBarcode'

                    ]
                ],

            ],
            [
                'name' => 'Warehouse',
                'icon' => 'faWarehouse',
                'route_url' => 'warehouse', 'active' => 1,

                'children' => [
                    [
                        'name' => 'Dispatch',
                        'route_url' => 'warehouse.dispatch',
                        'icon' => 'faTruckLoading'
                    ],

                    [
                        'name' => 'Track Pallets',
                        'route_url' => 'warehouse.track-pallets',
                        'icon' => 'faPallet'
                    ],


                    [
                        'name' => 'Locations',
                        'route_url' => 'warehouse.track-pallets',
                        'icon' => 'faPallet'
                    ],
                ]
            ],
            [
                'name' => 'Reports',
                'active' => 1,
                'route_url' => 'reports',
                'icon' => 'faChartLine',
                'children' => [
                    [
                        'name' => 'Shift Report',
                        'route_url' => 'reports.shift-report',
                        'icon' => 'faCalendarDay'

                    ]
                ]
            ],
            [
                'name' => 'Print',
                'active' => 1,
                'route_url' => 'print',
                'icon' => 'printer',
                'children' => [
                    [
                        'name' => 'Pallet Labels',
                        'route_url' => 'print.pallet-labels',
                        'icon' => 'faTags'
                    ],
                    [
                        'name' => "Reprint",
                        'route_url' => 'print.reprint',
                        'icon' => 'printer'
                    ],
                    [
                        'name' => 'Other labels',
                        'route_url' => 'print.choose-label',
                        'icon' => 'faFileAlt'
                    ]
                ]
            ]


        ];
    }
}
