<?php

namespace Icekristal\LaravelDraft\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $owner_type
 * @property integer $owner_id
 * @property string $key
 * @property mixed $info
 * @property boolean $is_public
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property $owner
 */
class Draft extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['owner_type', 'owner_id', 'key', 'info', 'is_public'];

    protected $casts = [
        'is_public' => 'boolean'
    ];


    /**
     *
     * Relation
     *
     * @return MorphTo
     *
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAccessShow(Builder $query): Builder
    {
        return $query->where(fn($q) => $q
            ->where(fn($w) => $w->where('owner_type', config('draft.model_client'))
            ->where('owner_id', auth()->user()->id))->orWhere('is_public', true)
        );
    }


}
