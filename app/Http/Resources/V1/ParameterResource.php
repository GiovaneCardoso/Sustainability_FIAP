<?php

namespace App\Http\Resources\V1;

// use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParameterResource extends ResourceCollection

{
    /**
     * @param $value
     * @return mixed
     */
    private function getValue( $value ){
        $object = json_decode($value);
        return json_last_error() === JSON_ERROR_NONE ?  $object: $value;
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        self::withoutWrapping();
      //  dd($this->collection->toArray());
        return $this->collection->map( fn ($parameter) => [
            $parameter->var => array_merge($parameter->toArray(),[
                'value' => $this->getValue( $parameter->value
                    ? $parameter->value
                    : $parameter->default_value),
            ])
        ])->collapse();
    }
}
