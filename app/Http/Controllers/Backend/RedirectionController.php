<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRedirectionRequest;
use App\Http\Requests\StoreRedirectionRequest;
use App\Http\Requests\UpdateRedirectionRequest;
use App\Imports\RedirectionListImport;
use App\Models\Redirection;
use App\Repositories\Contracts\RedirectionRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class RedirectionController extends Controller
{
    /**
     * @var RedirectionRepository
     */
    protected $redirections;

    /**
     * Create a new controller instance.
     *
     * @param RedirectionRepository $redirections
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function __construct(RedirectionRepository $redirections)
    {
        $this->redirections = $redirections;
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
        return view('backend.redirection.create');
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
        return view('backend.redirection.edit')->withRedirection($redirection);
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
     * @param Redirection $redirection
     * @param Request     $request
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

        return redirect()->back()->withFlashError(trans('alerts.backend.actions.invalid'));
    }

    /**
     * @param \App\Http\Requests\ImportRedirectionRequest $request
     * @param \App\Imports\RedirectionListImport          $import
     *
     * @return
     */
    public function import(ImportRedirectionRequest $request, RedirectionListImport $import)
    {
        $import->handleImport();

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.redirections.file_imported'));
    }
}
