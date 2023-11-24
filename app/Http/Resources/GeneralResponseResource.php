<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "meta" => [
                "success" => $this["success"],
                "errors" => $this["errors"]
            ],
            "data"=> $this["data"]
        ];
    }
}
