<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use App\Repositories\Contracts\FormSubmissionRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class FormSubmissionController extends Controller
{
    /**
     * @var FormSubmissionRepository
     */
    protected $formSubmissions;

    /**
     * Create a new controller instance.
     *
     * @param FormSubmissionRepository $formSubmissions
     */
    public function __construct(FormSubmissionRepository $formSubmissions)
    {
        $this->formSubmissions = $formSubmissions;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.form-submission.index');
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
                return trans("forms.{$formSubmission->type}.display_name");
            })->addColumn('actions', function (FormSubmission $formSubmission) {
                return $this->formSubmissions->getActionButtons($formSubmission);
            })->addColumn('created_at', function (FormSubmission $formSubmission) use ($request) {
                return $formSubmission->created_at->setTimezone($request->user()->timezone);
            })->addColumn('updated_at', function (FormSubmission $formSubmission) use ($request) {
                return $formSubmission->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @param \App\Models\FormSubmission $form_submission
     *
     * @return \Illuminate\Http\Response
     */
    public function show(FormSubmission $form_submission)
    {
        return view('backend.form-submission.show')->withFormSubmission($form_submission);
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

        return redirect()->back()->withFlashError(trans('alerts.backend.actions.invalid'));
    }
}
