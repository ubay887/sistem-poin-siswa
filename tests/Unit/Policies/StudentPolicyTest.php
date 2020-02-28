<?php

namespace Tests\Unit\Policies;

use App\Entities\Students\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_student()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Student));
    }

    /** @test */
    public function user_can_view_student()
    {
        $user = $this->createUser();
        $student = factory(Student::class)->create();
        $this->assertTrue($user->can('view', $student));
    }

    /** @test */
    public function user_can_update_student()
    {
        $user = $this->createUser();
        $student = factory(Student::class)->create();
        $this->assertTrue($user->can('update', $student));
    }

    /** @test */
    public function user_can_delete_student()
    {
        $user = $this->createUser();
        $student = factory(Student::class)->create();
        $this->assertTrue($user->can('delete', $student));
    }
}
