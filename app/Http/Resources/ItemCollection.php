<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map->only(
            'id',
            'code',
            'description',
            'active',
            'quantity',
            'trade_unit_barcode',
            'consumer_unit_barcode',
            'product_type_id',
            'brand',
            'variant',
            'unit_net_contents',
            'unit_of_measure_id',
            'days_life',
            'min_days_life',
            'comment',
            'deleted_at'
        );
    }
}
