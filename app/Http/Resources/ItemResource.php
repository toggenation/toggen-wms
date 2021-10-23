<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'description' => $this->description,
            'code_description' => $this->code_description,
            'active' => $this->active,
            'quantity' => $this->quantity,
            'trade_unit_barcode' => $this->trade_unit_barcode,
            'consumer_unit_barcode' => $this->consumer_unit_barcode,
            'product_type_id' => $this->product_type_id,
            // 'product_types' => $this->items()->orderByName()->get()->map->only('id', 'name'),
            'brand' => $this->brand,
            //id, active, code, description, quantity, trade_unit_barcode, consumer_unit_barcode, product_type_id, brand, variant, 
            // unit_net_contents, unit_of_measure_id, days_life, min_days_life, comment, created_at, updated_at
            'variant' => $this->variant,
            'unit_net_contents' => $this->unit_net_contents,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            // 'units_of_measure' => $this->items()->orderByName()->get()->map->only('id', 'name', 'slug'),
            'days_life' => $this->days_life,
            'min_days_life' => $this->min_days_life,
            'comment' => $this->comment,
            'deleted_at' => $this->deleted_at

            // 'contacts' => $this->contacts()->orderByName()->get()->map->only('id', 'name', 'city', 'phone'),
        ];
    }
}
