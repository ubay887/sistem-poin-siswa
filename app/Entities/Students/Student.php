<?php

namespace App\Entities\Students;

use App\Entities\Users\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'login_id', 'class_id',
        'nis', 'nisn', 'name',
        'pob', 'dob', 'gender_id', 'religion_id', 'phone', 'email', 'address',
        'father_name', 'father_phone',
        'mother_name', 'mother_phone',
        'wali_name', 'wali_relation', 'wali_phone',
        'is_active', 'creator_id',
    ];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('student.student'),
        ]);
        $link = '<a href="'.route('students.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
