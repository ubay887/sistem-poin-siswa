<?php

namespace App\Entities\References;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'site_options';

    protected $fillable = ['key', 'value'];

    public $timestamps = false;
}
