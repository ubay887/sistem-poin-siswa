<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Entities\Users\User;
use App\Entities\Students\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    /** @test */
    public function a_student_has_gender_attribute()
    {
        $student = factory(Student::class)->make(['gender_id' => 1]);
        $this->assertEquals(__('app.male'), $student->gender);

        $student->gender_id = 0;
        $this->assertEquals(__('app.female'), $student->gender);
    }

    /** @test */
    public function a_student_has_religion_attribute()
    {
        $student = factory(Student::class)->make(['religion_id' => 1]);
        $this->assertEquals(__('app.islam'), $student->religion);

        $student->religion_id = 2;
        $this->assertEquals(__('app.protestan'), $student->religion);

        $student->religion_id = 3;
        $this->assertEquals(__('app.katolik'), $student->religion);

        $student->religion_id = 4;
        $this->assertEquals(__('app.hindu'), $student->religion);

        $student->religion_id = 5;
        $this->assertEquals(__('app.budha'), $student->religion);

        $student->religion_id = 6;
        $this->assertEquals(__('app.khonghucu'), $student->religion);

        $student->religion_id = 99;
        $this->assertEquals(__('app.other'), $student->religion);
    }
}
