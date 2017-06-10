<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormSettingRequest;
use App\Http\Requests\UpdateFormSettingRequest;
use App\Models\FormSetting;
use App\Repositories\Contracts\FormSettingRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class FormSettingController extends Controller
{
    /**
     * @var FormSettingRepository
     */
    protected $formSettings;

    /**
     * Create a new controller instance.
     *
     * @param FormSettingRepository             $formSettings
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function __construct(FormSettingRepository $formSettings)
    {
        $this->formSettings = $formSettings;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.form-setting.index');
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
            $query = Datatables::of($this->formSettings->get());

            return $query->editColumn('name', function (FormSetting $formSetting) {
                return trans("forms.{$formSetting->name}.display_name");
            })->addColumn('actions', function (FormSetting $formSetting) {
                return $this->formSettings->getActionButtons($formSetting);
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
        $formTypes = collect(config('forms'));

        $formTypes->transform(function ($item) {
            return trans($item['display_name']);
        });

        return view('backend.form-setting.create')->withFormTypes($formTypes->toArray());
    }

    /**
     * @param StoreFormSettingRequest $request
     *
     * @return mixed
     */
    public function store(StoreFormSettingRequest $request)
    {
        $this->formSettings->store($request->input());

        return redirect()->route('admin.form_setting.index')->withFlashSuccess(trans('alerts.backend.form_settings.created'));
    }

    /**
     * @param FormSetting $formSetting
     *
     * @return mixed
     */
    public function edit(FormSetting $formSetting)
    {
        $formTypes = collect(config('forms'));

        $formTypes->transform(function ($item) {
            return trans($item['display_name']);
        });

        return view('backend.form-setting.edit')->withFormSetting($formSetting)->withFormTypes($formTypes->toArray());
    }

    /**
     * @param FormSetting              $formSetting
     * @param UpdateFormSettingRequest $request
     *
     * @return mixed
     */
    public function update(FormSetting $formSetting, UpdateFormSettingRequest $request)
    {
        $this->formSettings->update($formSetting, $request->input());

        return redirect()->route('admin.form_setting.index')->withFlashSuccess(trans('alerts.backend.form_settings.updated'));
    }

    /**
     * @param FormSetting    $formSetting
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(FormSetting $formSetting, Request $request)
    {
        $this->formSettings->destroy($formSetting);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.form_settings.deleted'));
    }
}
