<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'TotalPrice' => round((1 - ($this->discount/100)) * $this->price,2),
            /*
               discount/100 = .x
               1 - .x = .y
               .y * price = total price 

            */
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'no rating yet',
            'href' => [ 
                'reviews' => route('reviews.index',$this->id)
            ]
        ];
    }
}
