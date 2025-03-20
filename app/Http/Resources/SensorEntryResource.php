<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sensor_id' => $this->sensor_id,
            'value' => $this->value,
            'timestamp' => $this->created_at->toDateTimeString(),
        ];
    }
}
