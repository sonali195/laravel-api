<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = [
            'user' => [
                'id' => $this->id ?? null,
                'role_id' => $this->role_id ?? null,
                'name' => $this->name ?? null,
                'email' => $this->email ?? null,
                'country_code' => $this->country_code ?? null,
                'phone_number' => $this->phone_number ?? null,
                'is_complete_profile' => $this->is_complete_profile ?? 0,
            ],
        ];

        if ($this->auth_token) {
            $user['token'] = $this->auth_token;
        }

        return $user;
    }
}
