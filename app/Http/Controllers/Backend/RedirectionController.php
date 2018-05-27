<?php

namespace App\Http\Controllers\Backend;

use League\Csv\Reader;
use App\Models\Redirection;
use Illuminate\Http\Request;
use App\Utils\RequestSearchQuery;
use App\Http\Requests\StoreRedirectionRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateRedirectionRequest;
use App\Repositories\Contracts\RedirectionRepository;

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
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function search(Request $request)
    {
        $requestSearchQuery = new RequestSearchQuery($request, $this->redirections->query(), [
            'source',
            'target',
        ]);

        if ($request->get('exportData')) {
            return $requestSearchQuery->export([
                'source',
                'active',
                'target',
                'type',
                'created_at',
                'updated_at',
            ],
                [
                    __('validation.attributes.source_path'),
                    __('validation.attributes.active'),
                    __('validation.attributes.target_path'),
                    __('validation.attributes.redirect_type'),
                    __('labels.created_at'),
                    __('labels.updated_at'),
                ],
                'redirections');
        }

        return $requestSearchQuery->result([
            'id',
            'source',
            'active',
            'target',
            'type',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * @param Redirection $redirection
     *
     * @return Redirection
     */
    public function show(Redirection $redirection)
    {
        return $redirection;
    }

    public function getRedirectionTypes()
    {
        $redirections = config('redirections');

        array_walk($redirections, function (&$item) {
            $item = __($item);
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
        $this->authorize('create redirections');

        $this->redirections->store($request->input());

        return $this->redirectResponse($request, __('alerts.backend.redirections.created'));
    }

    /**
     * @param Redirection              $redirection
     * @param UpdateRedirectionRequest $request
     *
     * @return mixed
     */
    public function update(Redirection $redirection, UpdateRedirectionRequest $request)
    {
        $this->authorize('edit redirections');

        $this->redirections->update($redirection, $request->input());

        return $this->redirectResponse($request, __('alerts.backend.redirections.updated'));
    }

    /**
     * @param Redirection $redirection
     * @param Request     $request
     *
     * @return mixed
     */
    public function destroy(Redirection $redirection, Request $request)
    {
        $this->authorize('delete redirections');

        $this->redirections->destroy($redirection);

        return $this->redirectResponse($request, __('alerts.backend.redirections.deleted'));
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
                $this->authorize('delete redirections');

                $this->redirections->batchDestroy($ids);

                return $this->redirectResponse($request, __('alerts.backend.redirections.bulk_destroyed'));
                break;
            case 'enable':
                $this->authorize('edit redirections');

                $this->redirections->batchEnable($ids);

                return $this->redirectResponse($request, __('alerts.backend.redirections.bulk_enabled'));
                break;
            case 'disable':
                $this->authorize('edit redirections');

                $this->redirections->batchDisable($ids);

                return $this->redirectResponse($request, __('alerts.backend.redirections.bulk_disabled'));
                break;
        }

        return $this->redirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }

    public function activeToggle(Redirection $redirection)
    {
        $this->authorize('edit redirections');
        $redirection->update(['active' => ! $redirection->active]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \League\Csv\Exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $this->authorize('create redirections');

        $this->validate($request, [
            'import' => 'required',
        ]);

        $csv = Reader::createFromFileObject($request->file('import')->openFile())
            ->setHeaderOffset(0)
            ->setDelimiter(';');

        foreach ($csv as $row) {
            if (isset($row['source'], $row['target'])) {
                $this->redirections->store([
                    'source' => $row['source'],
                    'target' => $row['target'],
                    'type'   => Response::HTTP_MOVED_PERMANENTLY,
                ]);
            }
        }

        return $this->redirectResponse($request, __('alerts.backend.redirections.file_imported'));
    }
}
