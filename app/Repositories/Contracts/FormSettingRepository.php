<?php

namespace App\Repositories\Contracts;

use App\Models\FormSetting;

/**
 * Class EloquentFormSettingRepository.
 */
interface FormSettingRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function get();

    /**
     * @param $name
     *
     * @return FormSetting
     */
    public function find($name);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param FormSetting $formSetting
     * @param array       $input
     *
     * @return mixed
     */
    public function update(FormSetting $formSetting, array $input);

    /**
     * @param FormSetting $formSetting
     *
     * @return mixed
     */
    public function destroy(FormSetting $formSetting);

    /**
     * @param \App\Models\FormSetting $formSetting
     *
     * @return mixed
     */
    public function getActionButtons(FormSetting $formSetting);
}
