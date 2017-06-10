<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSetting.
 *
 * @property int $id
 * @property string $name
 * @property string $recipients
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereRecipients($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $html_message
 * @property-read mixed $array_recipients
 */
class FormSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'recipients',
            'message',
        ];

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
