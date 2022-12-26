<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UserResource;
use App\Http\Resources\PerformanceResource;
class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    
    public function toArray($request)
    {
        return [
        'id'=>$this->resource->id,
       'seats'=>$this->resource->seats,
       'user'=>new UserResource($this->resource->user),
       'performance'=>new PerformanceResource($this->resource->performance)
        ];
    }
}
