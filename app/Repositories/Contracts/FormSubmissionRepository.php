<?php

namespace App\Repositories\Contracts;

use App\Models\FormSubmission;

/**
 * Interface FormSubmissionRepository.
 */
interface FormSubmissionRepository extends BaseRepository
{
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
}
