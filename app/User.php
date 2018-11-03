<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;
    use HasUuid;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'id', 'password', 'remember_token'
    ];

    public function cheats()
    {
        return $this->hasMany('App\Cheat', 'creator_id');
    }
}
