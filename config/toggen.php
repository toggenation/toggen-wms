<?php

return [
    'icons' => [
        'additional' => [
            'printer' => 'Printer',
            'warehouse' => 'Locations'
        ]
    ],
    'warehouse' => [
        'capacity' => [
            'max' => 99999,
        ]
    ],
    'print' => [
        'template' =>
        [
            'templates' => 'print/templates',
            // path relative to storage/app 
            'examples' => 'print/examples'
        ]
    ],
    'batch' => [
        'ydddxx' => [
            'end' => 5
        ]
    ]
];
