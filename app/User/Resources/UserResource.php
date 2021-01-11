<?php

namespace App\User\Resources;

use App\Models\AccountUser;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use function MongoDB\BSON\fromJSON;
use function PHPUnit\Framework\assertJson;
use function PHPUnit\Framework\isJson;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'active' => $this->is_active,
            'email' => $this->email,
            'verified' => $this->email_verified_at,
//            'permissions' => $this->whenPivotLoaded('account_user', function () {
//                return $this->pivot->permissions;
//            })
        'permissions' => json_decode($this->pivot->permissions)
        ];
    }
}
