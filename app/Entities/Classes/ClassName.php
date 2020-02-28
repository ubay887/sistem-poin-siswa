<?php

namespace App\Entities\Classes;

use App\Entities\Users\User;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    protected $fillable = ['level_id', 'name', 'description', 'creator_id'];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('class_name.class_name'),
        ]);
        $link = '<a href="'.route('class_names.show', $this).'"';
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
