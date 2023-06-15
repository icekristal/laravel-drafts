<?php

namespace Icekristal\LaravelDraft\Http\Resources;

use Illuminate\Http\Request;

/**
 * @property mixed $id
 * @property boolean $is_public
 * @property object $info
 * @property string $key
 * @property string $created_at
 * @property string $owner
 */
class DraftResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'is_public' => $this->is_public,
            'author_info' => [
                'owner_type' => $this->owner->owner_type ?? null,
                'owner_id' => $this->owner->owner_id ?? null,
            ],
            'info' => $this->info,
            'created_at' => $this->created_at,
            'created_at_format' => $this->created_at?->format('d.m.Y H:i'),
        ];
    }
}
