<?php

namespace Tests\Feature;

use App\Entities\Students\Student;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageStudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_student_list_in_student_index_page()
    {
        $student = factory(Student::class)->create();

        $this->loginAsUser();
        $this->visitRoute('students.index');
        $this->see($student->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Student 1 name',
            'description' => 'Student 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_student()
    {
        $this->loginAsUser();
        $this->visitRoute('students.index');

        $this->click(__('student.create'));
        $this->seeRouteIs('students.create');

        $this->submitForm(__('student.create'), $this->getCreateFields());

        $this->seeRouteIs('students.show', Student::first());

        $this->seeInDatabase('students', $this->getCreateFields());
    }

    /** @test */
    public function validate_student_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('students.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('students.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('students.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Student 1 name',
            'description' => 'Student 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_student()
    {
        $this->loginAsUser();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('students.show', $student);
        $this->click('edit-student-'.$student->id);
        $this->seeRouteIs('students.edit', $student);

        $this->submitForm(__('student.update'), $this->getEditFields());

        $this->seeRouteIs('students.show', $student);

        $this->seeInDatabase('students', $this->getEditFields([
            'id' => $student->id,
        ]));
    }

    /** @test */
    public function validate_student_name_update_is_required()
    {
        $this->loginAsUser();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('students.update', $student), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('students.update', $student), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('students.update', $student), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_student()
    {
        $this->loginAsUser();
        $student = factory(Student::class)->create();
        factory(Student::class)->create();

        $this->visitRoute('students.edit', $student);
        $this->click('del-student-'.$student->id);
        $this->seeRouteIs('students.edit', [$student, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('students', [
            'id' => $student->id,
        ]);
    }
}
