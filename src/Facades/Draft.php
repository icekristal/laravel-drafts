<?php

namespace Icekristal\LaravelDraft\Facades;


use Icekristal\LaravelDraft\Services\IceDraftService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static IceDraftService setOwner($owner)
 * @method static IceDraftService getOwner()
 * @method static IceDraftService getDraft()
 * @method static IceDraftService setDraft(\Icekristal\LaravelDraft\Models\Draft $draft)
 * @method static IceDraftService setData(array $data)
 * @method static IceDraftService getData()
 * @method static IceDraftService store()
 * @method static IceDraftService update()
 * @method static IceDraftService delete()
 * @method static IceDraftService list()
 */
class Draft extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ice.draft';
    }
}
