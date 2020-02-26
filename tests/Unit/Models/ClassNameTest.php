<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Entities\Users\User;
use App\Entities\Classes\ClassName;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClassNameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_class_name_has_name_link_attribute()
    {
        $className = factory(ClassName::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $className->name, 'type' => __('class_name.class_name'),
        ]);
        $link = '<a href="'.route('class_names.show', $className).'"';
        $link .= ' title="'.$title.'">';
        $link .= $className->name;
        $link .= '</a>';

        $this->assertEquals($link, $className->name_link);
    }

    /** @test */
    public function a_class_name_has_belongs_to_creator_relation()
    {
        $className = factory(ClassName::class)->make();

        $this->assertInstanceOf(User::class, $className->creator);
        $this->assertEquals($className->creator_id, $className->creator->id);
    }
}
