<?php

namespace App\Services;

class Location
{

    protected $warehouses = ['MC', 'OB', "SS",];
    protected $aisles = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
    protected $columns = range(1, 14);
    protected $levels = range(1, 4);

    public function generate(...$args)
    {
        foreach ($args as $arr) {
        }
    }
}
