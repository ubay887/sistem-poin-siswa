<?php

namespace App\Entities\Classes;

use App\Entities\Users\User;
use App\Entities\Classes\Level;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    protected $fillable = ['level_id', 'name', 'description', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function getLevelAttribute()
    {
        $levelTypes = Level::$lists;

        return __('class_name.'.$levelTypes[$this->level_id]);
    }
}
