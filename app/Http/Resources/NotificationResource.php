<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $row = [
            'id' => $this->id ?? null,
            'type' => $this->type ?? null,
            'text' => $this->text ?? null,
            'created_at' => $this->created_at ?? null,
            'redirect_on' => $this->redirect_on != null ? intval(Helper::getDecryptedId($this->redirect_on)) : null,
            $this->mergeWhen(isset($this->others) && !empty($this->others), function () {
                return json_decode($this->others, true);
            }),
        ];

        if ($this->relationLoaded('user')) {
            $row['user'] = $this->user;
        }

        if ($this->relationLoaded('receiver')) {
            $row['receiver'] = $this->receiver;
        }

        return $row;
    }
}
