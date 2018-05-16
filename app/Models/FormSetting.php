<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use App\Models\Traits\TranslatableJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\FormSetting.
 *
 * @property int                 $id
 * @property string              $name
 * @property array               $message
 * @property string|null         $recipients
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed               $array_recipients
 * @property mixed               $can_delete
 * @property mixed               $can_edit
 * @property mixed               $html_message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormSetting whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormSetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormSetting whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FormSetting extends Model
{
    use HasTranslations;
    use TranslatableJson;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
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
        'message',
    ];

    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('delete form_settings');
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
