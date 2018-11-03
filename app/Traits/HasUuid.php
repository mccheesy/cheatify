<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

trait HasUuid
{
    // use the UUID for routes to mask numeric ID
    public function getRouteKeyName() : string
    { return 'uuid'; }

    // override this on the model if the
    // uuid column name is different
    protected static function getUuidKey() : string
    { return 'uuid'; }

    // override this on the model if the
    // column to use for uuid generation
    // is different (null to generate v4)
    protected static function getUuidSeed() : string
    { return 'name'; }

    protected static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            $model->generateUuidOnCreate();
        });
    }

    protected function generateUuidOnCreate()
    {
        if (!is_null($this->getUuidSeed())) {
            $uuid = Uuid::generate(5, $this->{$this->getUuidSeed()}, Uuid::NS_DNS);
        } else {
            $uuid = Uuid::generate(4);
        }
        $this->{$this->getUuidKey()} = $uuid->string;
    }
}
