<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMetaRequest;
use App\Http\Requests\UpdateMetaRequest;
use App\Models\Meta;
use App\Repositories\Contracts\MetaRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class MetaController extends Controller
{
    /**
     * @var MetaRepository
     */
    protected $metas;

    /**
     * @var array
     */
    protected $supportedLocales;

    /**
     * Create a new controller instance.
     *
     * @param MetaRepository             $metas
     * @param LaravelLocalization        $localization
     * @param \Illuminate\Routing\Router $router
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function __construct(MetaRepository $metas, LaravelLocalization $localization, Router $router)
    {
        $this->metas = $metas;
        $this->supportedLocales = $localization->getSupportedLocales();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.meta.index');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var EloquentEngine $collection */
            $query = Datatables::of($this->metas->get());

            return $query->editColumn('route', function (Meta $meta) {
                return trans($meta->route);
            })->addColumn('actions', function (Meta $meta) {
                return $this->metas->getActionButtons($meta);
            })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.meta.create')->withLocales($this->supportedLocales);
    }

    /**
     * @param StoreMetaRequest $request
     *
     * @return mixed
     */
    public function store(StoreMetaRequest $request)
    {
        $this->metas->store($request->input());

        return redirect()->route('admin.meta.index')->withFlashSuccess(trans('alerts.backend.metas.created'));
    }

    /**
     * @param Meta $meta
     *
     * @return mixed
     */
    public function edit(Meta $meta)
    {
        return view('backend.meta.edit')->withMeta($meta)->withLocales($this->supportedLocales);
    }

    /**
     * @param Meta              $meta
     * @param UpdateMetaRequest $request
     *
     * @return mixed
     */
    public function update(Meta $meta, UpdateMetaRequest $request)
    {
        $this->metas->update($meta, $request->input());

        return redirect()->route('admin.meta.index')->withFlashSuccess(trans('alerts.backend.metas.updated'));
    }

    /**
     * @param Meta    $meta
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Meta $meta, Request $request)
    {
        $this->metas->destroy($meta);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.metas.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');

        switch ($action) {
            case 'destroy':
                $this->metas->batchDestroy($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.metas.bulk_destroyed'));
                break;
        }
    }
}
