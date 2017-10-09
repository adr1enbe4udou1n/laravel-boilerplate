<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\FormSetting;
use App\Repositories\Contracts\FormSettingRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;

/**
 * Class EloquentFormSettingRepository.
 */
class EloquentFormSettingRepository extends EloquentBaseRepository implements FormSettingRepository
{
    use HtmlActionsButtons;

    /**
     * EloquentFormSettingRepository constructor.
     *
     * @param FormSetting $formSetting
     */
    public function __construct(FormSetting $formSetting)
    {
        parent::__construct($formSetting);
    }

    /**
     * @param $name
     *
     * @return FormSetting
     */
    public function find($name)
    {
        /* @var FormSetting $formSetting */
        return $this->query()->whereName($name)->first();
    }

    /**
     * @param array $input
     *
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\FormSetting
     */
    public function store(array $input)
    {
        /** @var FormSetting $formSetting */
        $formSetting = $this->make($input);

        if ($this->find($formSetting->name)) {
            throw new GeneralException(trans('exceptions.backend.form_settings.already_exist'));
        }

        if (!$formSetting->save()) {
            throw new GeneralException(trans('exceptions.backend.form_settings.create'));
        }

        return $formSetting;
    }

    /**
     * @param FormSetting $formSetting
     * @param array       $input
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\FormSetting
     */
    public function update(FormSetting $formSetting, array $input)
    {
        if (($existingFormSetting = $this->find($formSetting->name))
          && $existingFormSetting->id !== $formSetting->id
        ) {
            throw new GeneralException(trans('exceptions.backend.form_settings.already_exist'));
        }

        if (!$formSetting->update($input)) {
            throw new GeneralException(trans('exceptions.backend.form_settings.update'));
        }

        return $formSetting;
    }

    /**
     * @param FormSetting $formSetting
     *
     * @throws \Exception|\Throwable
     *
     * @return bool|null
     */
    public function destroy(FormSetting $formSetting)
    {
        if (!$formSetting->delete()) {
            throw new GeneralException(trans('exceptions.backend.form_settings.delete'));
        }

        return true;
    }

    /**
     * @param \App\Models\FormSetting $formSetting
     *
     * @return mixed
     */
    public function getActionButtons(FormSetting $formSetting)
    {
        $buttons = $this->getEditButtonHtml("/form-settings/{$formSetting->id}/edit")
            .$this->getDeleteButtonHtml('admin.form_settings.destroy', $formSetting, 'delete form_settings');

        return $buttons;
    }
}
