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
            'name'              => $this->name,
            'description'       => $this->detail,


            'category_id' => $this->category_id,
            'sub_category_id'=> $this->sub_category_id,
            'unit_id'       => $this->unit_id,
            'user_id'       => $this->user_id,
            'picture1'      => $this->picture1,
            'picture2'      => $this->picture2,
            'picture3'      => $this->picture3,
            'picture4'      => $this->picture4,
            'default_picture'=> $this->default_picture



            // 'price'             => $this->price,
            // 'stock'             => $this->stock> 0? $this->stock:"Out of Stock.",
            // 'discount'          => $this->discount,
            // 'totalPrice'        => round((1-($this->discount/100))*$this->price,2),
            // 'star'  => $this->reviews->count()>0? round($this->reviews->sum('star')/$this->reviews->count(),2):"Not Rating Yet.",            
            // 'href'              => [
            //     'reviews'       => route('reviews.index',$this->id)
            // ]
        ];
    }
}
