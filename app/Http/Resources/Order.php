<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'user'=>$this->user,
            'to_user_id'=>$this->to_user_id,
            'product_id'=>$this->product_id,
            'price'=>$this->price,
            'product'=>Product::find($this->product_id)['title'],
            'city'=>$this->city,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'content'=>$this->content,
            'times_at'=>$this->times_at,
            'times_end'=>$this->times_end,
            'start_at'=>substr($this->times_at,0,10),
            'end_at'=>substr($this->times_end,0,10),
            'is_native'=>$this->is_native,
            'age_at'=>$this->age_at,
            'age_end'=>$this->age_end,
            'day_at'=>$this->day_at,
            'rest_mode'=>$this->rest_mode,
            'other_requirements'=>$this->other_requirements,
            'emergency'=>$this->emergency,
            'is_call'=>$this->is_call,
            'status'=>$this->status,
            'status_mean'=>$this->status_mean,
            'offer_count'=>$this->offer_count,
            'comments_count'=>$this->comments_count,
            'likes_count'=>$this->likes_count,
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at->format('Y-m-d H:i'),
            'update_at'=>$this->update_at,
        ];
    }
}
