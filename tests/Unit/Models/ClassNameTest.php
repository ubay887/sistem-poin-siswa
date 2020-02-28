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
    public function a_class_name_has_belongs_to_creator_relation()
    {
        $className = factory(ClassName::class)->make();

        $this->assertInstanceOf(User::class, $className->creator);
        $this->assertEquals($className->creator_id, $className->creator->id);
    }

    /** @test */
    public function a_user_has_level_attribute()
    {
        $className = factory(ClassName::class)->make(['level_id' => 1]);
        $this->assertEquals(__('class_name.i'), $className->level);

        $className->level_id = 2;
        $this->assertEquals(__('class_name.ii'), $className->level);

        $className->level_id = 3;
        $this->assertEquals(__('class_name.iii'), $className->level);

        $className->level_id = 4;
        $this->assertEquals(__('class_name.iv'), $className->level);

        $className->level_id = 5;
        $this->assertEquals(__('class_name.v'), $className->level);

        $className->level_id = 6;
        $this->assertEquals(__('class_name.vi'), $className->level);

        $className->level_id = 7;
        $this->assertEquals(__('class_name.vii'), $className->level);

        $className->level_id = 8;
        $this->assertEquals(__('class_name.viii'), $className->level);

        $className->level_id = 9;
        $this->assertEquals(__('class_name.ix'), $className->level);

        $className->level_id = 10;
        $this->assertEquals(__('class_name.x'), $className->level);

        $className->level_id = 11;
        $this->assertEquals(__('class_name.xi'), $className->level);

        $className->level_id = 12;
        $this->assertEquals(__('class_name.xii'), $className->level);
    }
}
