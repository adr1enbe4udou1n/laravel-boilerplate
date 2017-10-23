<?php

namespace App\Events;

use App\Models\FormSubmission;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class FormSubmissionCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var FormSubmission
     */
    public $formSubmission;

    /**
     * @param \App\Models\FormSubmission $formSubmission
     *
     * @internal param $user
     */
    public function __construct(FormSubmission $formSubmission)
    {
        $this->formSubmission = $formSubmission;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('form-submission');
    }
}
