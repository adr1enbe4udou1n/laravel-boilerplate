<?php

namespace App\Http\Controllers\Backend;

use App\Models\Meta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMetaRequest;
use App\Http\Requests\UpdateMetaRequest;
use App\Repositories\Contracts\MetaRepository;

class MetaController extends BackendController
{
    /**
     * @var MetaRepository
     */
    protected $metas;

    /**
     * Create a new controller instance.
     *
     * @param MetaRepository $metas
     */
    public function __construct(MetaRepository $metas)
    {
        $this->metas = $metas;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $query = $this->metas->query()
                ->join('meta_translations as mt', 'mt.meta_id', '=', 'metas.id')
                ->where('mt.locale', '=', app()->getLocale());

            return $this->searchQuery($request, $query, [
                'metas.id',
                'route',
                'metable_type',
                'metable_id',
                'mt.title',
                'mt.description',
                'created_at',
                'updated_at',
            ], [
                'mt.title',
                'mt.description',
            ]);
        }
    }

    /**
     * @param Meta $meta
     *
     * @return Meta
     */
    public function show(Meta $meta)
    {
        return $meta;
    }

    /**
     * @param StoreMetaRequest $request
     *
     * @return mixed
     */
    public function store(StoreMetaRequest $request)
    {
        $this->authorize('create metas');

        $this->metas->store($request->input());

        return $this->redirectResponse($request, __('alerts.backend.metas.created'));
    }

    /**
     * @param Meta              $meta
     * @param UpdateMetaRequest $request
     *
     * @return mixed
     */
    public function update(Meta $meta, UpdateMetaRequest $request)
    {
        $this->authorize('edit metas');

        $this->metas->update($meta, $request->input());

        return $this->redirectResponse($request, __('alerts.backend.metas.updated'));
    }

    /**
     * @param Meta    $meta
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Meta $meta, Request $request)
    {
        $this->authorize('delete metas');

        $this->metas->destroy($meta);

        return $this->redirectResponse($request, __('alerts.backend.metas.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');

        switch ($action) {
            case 'destroy':
                $this->authorize('delete metas');

                $this->metas->batchDestroy($ids);

                return $this->redirectResponse($request, __('alerts.backend.metas.bulk_destroyed'));
                break;
        }

        return $this->redirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }
}
