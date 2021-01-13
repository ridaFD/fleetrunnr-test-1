<?php

namespace App\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEmailConfirmationResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }

    public function with($request)
    {
        return ['message' => 'success'];
    }
}
