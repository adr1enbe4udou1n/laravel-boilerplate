<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRedirectionRequest;
use App\Http\Requests\UpdateRedirectionRequest;
use App\Models\Redirection;
use App\Repositories\Contracts\RedirectionRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class RedirectionController extends Controller
{
    /**
     * @var RedirectionRepository
     */
    protected $redirections;

    /**
     * @var array
     */
    protected $supportedLocales;

    /**
     * Create a new controller instance.
     *
     * @param RedirectionRepository      $redirections
     * @param LaravelLocalization        $localization
     * @param \Illuminate\Routing\Router $router
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function __construct(RedirectionRepository $redirections, LaravelLocalization $localization, Router $router)
    {
        $this->redirections = $redirections;
        $this->supportedLocales = $localization->getSupportedLocales();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.redirection.index');
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
            $query = Datatables::of($this->redirections->get());

            return $query->editColumn('active', function (Redirection $redirection) {
                return boolean_html_label($redirection->active);
            })->editColumn('route', function (Redirection $redirection) {
                return trans("routes.{$redirection->route}");
            })->addColumn('actions', function (Redirection $redirection) {
                return $this->redirections->getActionButtons($redirection);
            })
                ->rawColumns(['active', 'actions'])
                ->make(true);
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.redirection.create')->withLocales($this->supportedLocales);
    }

    /**
     * @param StoreRedirectionRequest $request
     *
     * @return mixed
     */
    public function store(StoreRedirectionRequest $request)
    {
        $this->redirections->store($request->input());

        return redirect()->route('admin.redirection.index')->withFlashSuccess(trans('alerts.backend.redirections.created'));
    }

    /**
     * @param Redirection $redirection
     *
     * @return mixed
     */
    public function edit(Redirection $redirection)
    {
        return view('backend.redirection.edit')->withRedirection($redirection)->withLocales($this->supportedLocales);
    }

    /**
     * @param Redirection              $redirection
     * @param UpdateRedirectionRequest $request
     *
     * @return mixed
     */
    public function update(Redirection $redirection, UpdateRedirectionRequest $request)
    {
        $this->redirections->update($redirection, $request->input());

        return redirect()->route('admin.redirection.index')->withFlashSuccess(trans('alerts.backend.redirections.updated'));
    }

    /**
     * @param Redirection    $redirection
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Redirection $redirection, Request $request)
    {
        $this->redirections->destroy($redirection);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.redirections.deleted'));
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
                $this->redirections->batchDestroy($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.redirections.bulk_destroyed'));
                break;
            case 'enable':
                $this->redirections->batchEnable($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.redirections.bulk_enabled'));
                break;
            case 'disable':
                $this->redirections->batchDisable($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.redirections.bulk_disabled'));
                break;
        }
    }
}
