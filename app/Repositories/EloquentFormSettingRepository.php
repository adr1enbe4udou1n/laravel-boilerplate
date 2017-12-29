<?php

namespace App\Repositories;

use Exception;
use App\Models\FormSetting;
use App\Exceptions\GeneralException;
use App\Repositories\Contracts\FormSettingRepository;

/**
 * Class EloquentFormSettingRepository.
 */
class EloquentFormSettingRepository extends EloquentBaseRepository implements FormSettingRepository
{
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
            throw new GeneralException(__('exceptions.backend.form_settings.already_exist'));
        }

        if (! $formSetting->save()) {
            throw new GeneralException(__('exceptions.backend.form_settings.create'));
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
            throw new GeneralException(__('exceptions.backend.form_settings.already_exist'));
        }

        if (! $formSetting->update($input)) {
            throw new GeneralException(__('exceptions.backend.form_settings.update'));
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
        if (! $formSetting->delete()) {
            throw new GeneralException(__('exceptions.backend.form_settings.delete'));
        }

        return true;
    }
}
