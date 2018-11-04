<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Cheat extends Model
{
    use HasUuid;

    protected $fillable = [
        'name', 'description', 'code', 'status', 'creator_id',
    ];

    protected $hidden = [
        'id',
    ];

    protected $with = [
        'creator',
    ];

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
}
