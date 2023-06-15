<?php

namespace Icekristal\LaravelDraft\Http\Resources;

use App\Http\Resources\BaseCollection;

class DraftsCollection extends BaseCollection
{
    public $collects = DraftResource::class;
}
