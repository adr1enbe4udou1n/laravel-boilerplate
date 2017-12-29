<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSetting.
 */
class FormSetting extends Model
{
    use Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'message',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'recipients',
    ];

    /**
     * The relationship that are eager loaded.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('access all backend') || Gate::check('delete form_settings');
    }

    public function getArrayRecipientsAttribute()
    {
        return explode(',', $this->recipients);
    }

    public function getHtmlMessageAttribute()
    {
        $message = explode("\r\n", $this->message);

        return '<p>'.implode("</p>\r\n<p>", $message).'</p>'."\r\n";
    }
}
