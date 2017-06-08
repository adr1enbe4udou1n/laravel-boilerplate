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
use Yajra\Datatables\Html\Builder;

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
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Datatables Html Builder.
     *
     * @var Builder
     */
    protected $htmlBuilder;

    /**
     * Create a new controller instance.
     *
     * @param MetaRepository             $metas
     * @param Builder                    $htmlBuilder
     * @param LaravelLocalization        $localization
     * @param \Illuminate\Routing\Router $router
     */
    public function __construct(MetaRepository $metas, LaravelLocalization $localization, Router $router, Builder $htmlBuilder)
    {
        $this->metas = $metas;
        $this->supportedLocales = $localization->getSupportedLocales();
        $this->router = $router;
        $this->htmlBuilder = $htmlBuilder;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $html = $this->htmlBuilder
            ->setTableAttribute('class', 'table table-bordered table-hover')
            ->setTableAttribute('width', '100%')
            ->parameters([
                'select' => ['style' => 'os'],
                'order' => ['order' => [[0, 'asc'], [1, 'asc']]],
                'rowId' => 'id',
            ])
            ->addCheckbox([
                'title' => '',
                'defaultContent' => '',
                'className' => 'select-checkbox',
            ])
            ->addColumn(['data' => 'locale', 'name' => 'locale', 'title' => trans('validation.attributes.locale')])
            ->addColumn(['data' => 'route', 'name' => 'route', 'title' => trans('validation.attributes.route')])
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => trans('validation.attributes.title'), 'width' => 200])
            ->addColumn(['data' => 'description', 'name' => 'description', 'title' => trans('validation.attributes.description'), 'orderable' => false])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => trans('labels.created_at'), 'width' => 100])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => trans('labels.updated_at'), 'width' => 100])
            ->addColumn(['data' => 'actions', 'name' => 'actions', 'title' => trans('labels.actions'), 'width' => 50, 'orderable' => false])
            ->ajax(['url' => route('admin.meta.search'), 'type' => 'post']);

        return view('backend.meta.index', compact('html'));
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

            return $query->editColumn('name', function (Meta $meta) {
                return link_to_route('admin.meta.edit', $meta->title, $meta);
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
        $meta->uri = $this->router->getRoutes()->getByName($meta->route)->uri();

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
