<?php

namespace Icekristal\LaravelDraft\Http\Controllers;

use App\Http\Controllers\Controller;
use Icekristal\LaravelDraft\Facades\Draft;
use Icekristal\LaravelDraft\Http\Draft\DeleteRequest;
use Icekristal\LaravelDraft\Http\Draft\StoreRequest;
use Icekristal\LaravelDraft\Http\Draft\UpdateRequest;
use Icekristal\LaravelDraft\Http\Resources\DraftResource;
use Icekristal\LaravelDraft\Http\Resources\DraftsCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DraftsController extends Controller
{

    /**
     *
     * @param Request $request
     * @return DraftsCollection
     */
    public function index(Request $request): DraftsCollection
    {
        return Draft::setOwner(auth()->user())->list();
    }

    /**
     * Create new draft
     *
     * @param StoreRequest $request
     * @return DraftResource
     * @throws \Exception
     */
    public function store(StoreRequest $request): DraftResource
    {
        return new DraftResource(Draft::setOwner(auth()->user())->setData($request->validated())->store());
    }

    /**
     * update draft
     *
     * @param UpdateRequest $request
     * @param \Icekristal\LaravelDraft\Models\Draft $draft
     * @return DraftResource
     * @throws \Exception
     */
    public function update(UpdateRequest $request, \Icekristal\LaravelDraft\Models\Draft $draft): DraftResource
    {
        return new DraftResource(Draft::setData($request->validated())->setDraft($draft)->update());
    }

    /**
     * @param DeleteRequest $request
     * @param \Icekristal\LaravelDraft\Models\Draft $draft
     * @return Response
     */
    public function delete(DeleteRequest $request, \Icekristal\LaravelDraft\Models\Draft $draft): Response
    {
        Draft::setDraft($draft)->delete();
        return new Response([
            'status' => true,
            'message' => "Draft success delete"
        ]);
    }
}
