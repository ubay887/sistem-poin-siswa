<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name', 'address', 'district', 'province', 'pos',
        'phone', 'email', 'web', 'logo', 'description', 'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
