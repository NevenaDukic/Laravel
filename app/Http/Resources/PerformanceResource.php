<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TheatreResource;
class PerformanceResource extends JsonResource
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
            'id' =>$this->resource->id,
           'name'=>$this->resource->name,
           'genre'=>$this->resource->genre,
           'number_of_roles'=>$this->resource->number_of_roles,
           'theatre'=>new TheatreResource($this->resource->theatre)
        ];
    }
}
