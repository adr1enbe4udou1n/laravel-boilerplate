<?php

namespace App\Repositories\Contracts;

use App\Models\FormSetting;

/**
 * Interface FormSettingRepository.
 */
interface FormSettingRepository extends BaseRepository
{
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
}
