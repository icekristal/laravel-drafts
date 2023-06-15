<?php

namespace Icekristal\LaravelDraft\Services;

use Icekristal\LaravelDraft\Http\Resources\DraftsCollection;
use Icekristal\LaravelDraft\Models\Draft;
use Illuminate\Support\Facades\Cache;

class IceDraftService
{
    public Draft $draft;
    public $owner = null;
    public array $data = [];

    /**
     * @return Draft
     */
    public function getDraft(): Draft
    {
        return $this->draft;
    }

    /**
     * @param Draft $draft
     * @return IceDraftService
     */
    public function setDraft(Draft $draft): IceDraftService
    {
        $this->draft = $draft;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return IceDraftService
     */
    public function setData(array $data): IceDraftService
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return null
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param null $owner
     */
    public function setOwner($owner): IceDraftService
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @param bool $isStore
     * @return bool
     */
    private function isValidData(bool $isStore = true): bool
    {
        if (is_null($this->owner) && $isStore) return false;
        if ($this->data == []) return false;
        if (!isset($this->data['info']) || is_null($this->data['info'])) return false;
        return true;
    }


    /**
     * get list drafts for owner
     *
     * @return DraftsCollection
     */
    public function list(): DraftsCollection
    {
        if (config('draft.is_enable_cache')) {
            $maxUpdateAt = md5(Draft::query()->accessShow()->count() . "_" . Draft::query()->accessShow()->max('updated_at'));
            return Cache::remember("list_drafts_{$maxUpdateAt}", 60 * 60 * 24, function () {
                return new DraftsCollection(Draft::query()->with(['owner'])->accessShow()->get());
            });
        }
        return new DraftsCollection(Draft::query()->with(['owner'])->accessShow()->get());
    }

    /**
     * Store draft
     *
     * @return Draft
     * @throws \Exception
     */
    public function store(): Draft
    {
        if (!$this->isValidData()) return throw new \Exception('Valid error store draft');
        $this->data['owner_type'] = get_class($this->owner);
        $this->data['owner_id'] = $this->owner->id;
        $this->draft = Draft::query()->create($this->data);
        return $this->draft;
    }

    /**
     * Update draft
     * @return Draft
     * @throws \Exception
     */
    public function update(): Draft
    {
        if (!$this->isValidData(false)) return throw new \Exception('Valid error update draft');
        $this->draft->update($this->data);
        return $this->draft;
    }

    public function delete(): bool
    {
        return $this->draft->delete();
    }

}
