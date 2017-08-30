<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreMetaRequest;
use App\Http\Requests\UpdateMetaRequest;
use App\Models\Meta;
use App\Repositories\Contracts\MetaRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var \Yajra\DataTables\EloquentDataTable $query */
            $query = DataTables::of($this->metas->select([
                'id',
                'route',
                'metable_type',
                'metable_id',
                'created_at',
                'updated_at',
            ]));

            return $query->editColumn('metable_type', function (Meta $meta) {
                return $meta->metable_type ? trans("labels.morphs.{$meta->metable_type}", ['id' => $meta->metable_id]) : null;
            })->addColumn('actions', function (Meta $meta) {
                return $this->metas->getActionButtons($meta);
            })->editColumn('created_at', function (Meta $meta) use ($request) {
                return $meta->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (Meta $meta) use ($request) {
                return $meta->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['actions'])
                ->make(true);
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

        return $this->RedirectResponse($request, trans('alerts.backend.metas.created'));
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

        return $this->RedirectResponse($request, trans('alerts.backend.metas.updated'));
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

        return $this->RedirectResponse($request, trans('alerts.backend.metas.deleted'));
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

                return $this->RedirectResponse($request, trans('alerts.backend.metas.bulk_destroyed'));
                break;
        }

        return $this->RedirectResponse($request, trans('alerts.backend.actions.invalid'), 'error');
    }
}
