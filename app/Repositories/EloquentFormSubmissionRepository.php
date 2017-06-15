<?php

namespace App\Repositories;

use App\Events\FormSubmissionCreated;
use App\Exceptions\GeneralException;
use App\Models\FormSubmission;
use App\Repositories\Contracts\FormSubmissionRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentFormSubmissionRepository.
 */
class EloquentFormSubmissionRepository extends EloquentBaseRepository implements FormSubmissionRepository
{
    use HtmlActionsButtons;

    /**
     * EloquentFormSubmissionRepository constructor.
     *
     * @param FormSubmission $formSubmission
     */
    public function __construct(FormSubmission $formSubmission)
    {
        parent::__construct($formSubmission);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->query()->select([
            'id',
            'type',
            'data',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * @param string $type
     * @param array  $input
     *
     * @return \App\Models\FormSubmission
     *
     * @throws \Exception|\Throwable
     */
    public function store($type, array $input)
    {
        // Exclude csrf & captcha from inputs
        Arr::forget($input, ['_token', 'g-recaptcha-response']);

        /** @var FormSubmission $formSubmission */
        $formSubmission = $this->make();
        $formSubmission->type = $type;
        $formSubmission->data = json_encode($input);

        DB::transaction(function () use ($formSubmission) {
            if ($formSubmission->save()) {
                event(new FormSubmissionCreated($formSubmission));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.form_submissions.create'));
        });

        return $formSubmission;
    }

    /**
     * @param FormSubmission $formSubmission
     *
     * @return bool|null
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(FormSubmission $formSubmission)
    {
        if (!$formSubmission->delete()) {
            throw new GeneralException(trans('exceptions.backend.form_submissions.delete'));
        }

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            // This wont call eloquent events, change to destroy if needed
            if ($this->query()->whereIn('id', $ids)->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.form_submissions.delete'));
        });

        return true;
    }

    /**
     * @param \App\Models\FormSubmission $formSubmission
     *
     * @return mixed
     */
    public function getActionButtons(FormSubmission $formSubmission)
    {
        $buttons =
            $this->getShowButtonHtml('admin.form_submission.show',
                $formSubmission).
            $this->getDeleteButtonHtml('admin.form_submission.destroy',
                $formSubmission);

        return $buttons;
    }
}
