<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialLogin.
 *
 * @property int                 $id
 * @property int                 $user_id
 * @property string              $provider
 * @property string              $provider_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialLogin whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialLogin whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialLogin whereUserId($value)
 * @mixin \Eloquent
 */
class SocialLogin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
    ];
}
