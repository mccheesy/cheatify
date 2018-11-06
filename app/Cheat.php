<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
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

    protected static function boot()
    {
        parent::boot();
        // default order in desc by created_at
        static::addGlobalScope('latest_first', function (Builder $builder) {
            $builder->orderByDesc('created_at');
        });
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
}
