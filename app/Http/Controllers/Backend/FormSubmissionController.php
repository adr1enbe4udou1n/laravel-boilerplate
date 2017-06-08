<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use App\Repositories\Contracts\FormSubmissionRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Html\Builder;

class FormSubmissionController extends Controller
{
    /**
     * @var FormSubmissionRepository
     */
    protected $formSubmissions;

    /**
     * Datatables Html Builder.
     *
     * @var Builder
     */
    protected $htmlBuilder;

    /**
     * Create a new controller instance.
     *
     * @param FormSubmissionRepository $formSubmissions
     * @param Builder                  $htmlBuilder
     */
    public function __construct(FormSubmissionRepository $formSubmissions, Builder $htmlBuilder)
    {
        $this->formSubmissions = $formSubmissions;
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
            ->addColumn(['data' => 'type', 'name' => 'type', 'title' => trans('validation.attributes.form_type')])
            ->addColumn(['data' => 'data', 'name' => 'data', 'title' => trans('validation.attributes.form_data')])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => trans('labels.created_at'), 'width' => 100])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => trans('labels.updated_at'), 'width' => 100])
            ->addColumn(['data' => 'actions', 'name' => 'actions', 'title' => trans('labels.actions'), 'width' => 50, 'orderable' => false])
            ->ajax(['url' => route('admin.form_submission.search'), 'type' => 'post']);

        return view('backend.form-submission.index', compact('html'));
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
            $query = Datatables::of($this->formSubmissions->get());

            return $query->editColumn('type', function (FormSubmission $formSubmission) {
                return trans($formSubmission->type_label);
            })->addColumn('actions', function (FormSubmission $formSubmission) {
                return $this->formSubmissions->getActionButtons($formSubmission);
            })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * @param FormSubmission $form_submission
     * @param Request        $request
     *
     * @return mixed
     */
    public function destroy(FormSubmission $form_submission, Request $request)
    {
        $this->formSubmissions->destroy($form_submission);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.form_submissions.deleted'));
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
                $this->formSubmissions->batchDestroy($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.form_submissions.bulk_destroyed'));
                break;
        }
    }
}
