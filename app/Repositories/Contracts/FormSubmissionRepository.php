<?php

namespace App\Repositories\Contracts;

use App\Models\FormSubmission;

/**
 * Class EloquentFormSubmissionRepository.
 */
interface FormSubmissionRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function get();

    /**
     * @param string $type
     * @param array  $input
     *
     * @return mixed
     */
    public function store($type, array $input);

    /**
     * @param FormSubmission $formSubmission
     *
     * @return mixed
     */
    public function destroy(FormSubmission $formSubmission);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @param \App\Models\FormSubmission $formSubmission
     *
     * @return mixed
     */
    public function getActionButtons(FormSubmission $formSubmission);
}
