<?php

namespace Icekristal\LaravelDraft;

use Icekristal\LaravelDraft\Models\Draft;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait DraftTrait
{
    /**
     *
     * @return MorphMany
     */
    public function drafts(): MorphMany
    {
        return $this->morphMany(Draft::class, 'owner');
    }
}
