<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Entities\Students\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_student()
    {
        $admin = $this->createUser('admin');
        $this->assertTrue($admin->can('create', new Student));
    }

    /** @test */
    public function user_can_view_student()
    {
        $admin = $this->createUser('admin');
        $student = factory(Student::class)->create();
        $this->assertTrue($admin->can('view', $student));
    }

    /** @test */
    public function user_can_update_student()
    {
        $admin = $this->createUser('admin');
        $student = factory(Student::class)->create();
        $this->assertTrue($admin->can('update', $student));
    }

    /** @test */
    public function user_can_delete_student()
    {
        $admin = $this->createUser('admin');
        $student = factory(Student::class)->create();
        $this->assertTrue($admin->can('delete', $student));
    }
}
