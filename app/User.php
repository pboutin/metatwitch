<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * Class User
 * @package App
 *
 *
 * @property string $username
 * @property string $email
 * @property string $bio
 * @property string $nickname
 * @property int    $twitch_id
 * @property string $logo
 * @property string last_activity
 * @property string current_channel
 */
class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'twitch_id',
        'bio',
        'nickname',
        'logo',
        'last_activity',
        'current_channel'
    ];


    /**
     * Set a new last activity date in the model
     */
    public function updateLastActivity()
    {
        $date = date('Y-m-d H:i:s');
        $this->last_activity = $date;
    }
}
