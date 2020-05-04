<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = [];

    public function setCompleteAttribute($value)
    {
        $this->attributes['complete'] = (bool) $value;
    }

    public function getCompleteAttribute($value)
    {
        return (bool) $value;
    }
}
