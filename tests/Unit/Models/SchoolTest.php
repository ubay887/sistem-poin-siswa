<?php

namespace Tests\Unit\Models;

use App\User;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_class_name_has_belongs_to_creator_relation()
    {
        $school = factory(School::class)->make();

        $this->assertInstanceOf(User::class, $school->creator);
        $this->assertEquals($school->creator_id, $school->creator->id);
    }
}
