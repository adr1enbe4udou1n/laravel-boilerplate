<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreRedirectionRequest;
use App\Http\Requests\UpdateRedirectionRequest;
use App\Imports\RedirectionListImport;
use App\Models\Redirection;
use App\Repositories\Contracts\RedirectionRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class RedirectionController extends BackendController
{
    /**
     * @var RedirectionRepository
     */
    protected $redirections;

    /**
     * Create a new controller instance.
     *
     * @param RedirectionRepository $redirections
     */
    public function __construct(RedirectionRepository $redirections)
    {
        $this->redirections = $redirections;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var EloquentEngine $query */
            $query = Datatables::of($this->redirections->select([
                'id',
                'source',
                'active',
                'target',
                'type',
                'created_at',
                'updated_at',
            ]));

            return $query->editColumn('active', function (Redirection $redirection) {
                return boolean_html_label($redirection->active);
            })->addColumn('actions', function (Redirection $redirection) {
                return $this->redirections->getActionButtons($redirection);
            })->editColumn('created_at', function (Redirection $redirection) use ($request) {
                return $redirection->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (Redirection $redirection) use ($request) {
                return $redirection->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['active', 'actions'])
                ->make(true);
        }
    }

    /**
     * @param Redirection $redirection
     *
     * @return Redirection
     */
    public function get(Redirection $redirection)
    {
        return $redirection;
    }

    public function getRedirectionTypes()
    {
        $redirections = config('redirections');

        array_walk($redirections, function (&$item) {
            $item = trans($item);
        });

        return $redirections;
    }

    /**
     * @param StoreRedirectionRequest $request
     *
     * @return mixed
     */
    public function store(StoreRedirectionRequest $request)
    {
        $this->redirections->store($request->input());

        return $this->RedirectResponse($request, trans('alerts.backend.redirections.created'));
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

        return $this->RedirectResponse($request, trans('alerts.backend.redirections.updated'));
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

        return $this->RedirectResponse($request, trans('alerts.backend.redirections.deleted'));
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
                $this->redirections->batchDestroy($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.redirections.bulk_destroyed'));
                break;
            case 'enable':
                $this->redirections->batchEnable($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.redirections.bulk_enabled'));
                break;
            case 'disable':
                $this->redirections->batchDisable($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.redirections.bulk_disabled'));
                break;
        }

        return $this->RedirectResponse($request, trans('alerts.backend.actions.invalid'), 'error');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Imports\RedirectionListImport $import
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request, RedirectionListImport $import)
    {
        $import->handleImport();

        return $this->RedirectResponse($request, trans('alerts.backend.redirections.file_imported'));
    }
}
