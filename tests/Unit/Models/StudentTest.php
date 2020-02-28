<?php

namespace Tests\Unit\Models;

use App\Entities\Users\User;
use App\Entities\Students\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_student_has_name_link_attribute()
    {
        $student = factory(Student::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $student->name, 'type' => __('student.student'),
        ]);
        $link = '<a href="'.route('students.show', $student).'"';
        $link .= ' title="'.$title.'">';
        $link .= $student->name;
        $link .= '</a>';

        $this->assertEquals($link, $student->name_link);
    }

    /** @test */
    public function a_student_has_belongs_to_creator_relation()
    {
        $student = factory(Student::class)->make();

        $this->assertInstanceOf(User::class, $student->creator);
        $this->assertEquals($student->creator_id, $student->creator->id);
    }
}
