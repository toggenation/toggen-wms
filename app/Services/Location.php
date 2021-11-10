<?php

namespace App\Services;

class Location
{

    protected $warehouses = ['MC', 'OB', "SS",];
    protected $aisles = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
    protected $columns;
    protected $levels;

    public function __construct()
    {
        $this->columns = range(1, 14);
        $this->levels = range(1, 4);
    }

    public function generate()
    {

        foreach ($this->warehouses as $warehouse) {
            foreach ($this->aisles as $aisle) {
                foreach ($this->columns as $column) {
                    foreach ($this->levels as $level) {
                        $locations[] = strtoupper(
                            join(
                                "",
                                [
                                    $warehouse,
                                    $aisle,
                                    sprintf('%02d', $column),
                                    sprintf('%02d', $level)
                                ]
                            )
                        );
                    }
                }
            }
        }
        return $locations;
    }
}
