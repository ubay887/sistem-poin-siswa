<?php

namespace Tests\Unit\Policies;

use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_class_name()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new School));
    }

    /** @test */
    public function user_can_update_class_name()
    {
        $user = $this->createUser();
        $school = factory(School::class)->create();
        $this->assertTrue($user->can('update', $school));
    }

    /** @test */
    public function user_can_delete_class_name()
    {
        $user = $this->createUser();
        $school = factory(School::class)->create();
        $this->assertTrue($user->can('delete', $school));
    }
}
