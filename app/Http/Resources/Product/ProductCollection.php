<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name'              => $this->name,
            // 'totalPrice'        => round((1-($this->discount/100))*$this->price,2),
            // 'discount'          => $this->discount,
            // 'rating'  => $this->reviews->count()>0? round($this->reviews->sum('star')/$this->reviews->count(),2):"Not Rating Yet.",            
            // 'href'              => [
            //     'links'       => route('products.show',$this->id)
            // ],
        ];
    }
}
