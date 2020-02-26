<?php

namespace App\Entities\Options;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps = false;
}
