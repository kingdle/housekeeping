<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cycle extends JsonResource
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
            'product'=>$this->product,
            'title'=>$this->title,
            'price'=>$this->price,
            'period'=>$this->period,
            'times_at'=>$this->times_at,
            'times_end'=>$this->times_end,
            'start_at'=>substr($this->times_at,0,10),
            'end_at'=>substr($this->times_end,0,10),
            'trains_count'=>$this->trains_count,
            'enrolments_count'=>$this->enrolments_count,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'address'=>$this->address,
            'address_name'=>$this->address_name,
            'linkman'=>$this->linkman,
            'phone'=>$this->phone,
            'remark'=>$this->remark,
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at->format('Y-m-d H:i'),
            'update_at'=>$this->update_at,
        ];
    }
}
