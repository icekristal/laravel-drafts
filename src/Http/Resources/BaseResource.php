<?php

namespace Icekristal\LaravelDraft\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function with($request)
    {
        return [
            'status' => true
        ];
    }
}
