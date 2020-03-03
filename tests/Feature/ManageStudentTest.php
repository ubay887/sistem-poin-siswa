<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entities\Users\User;
use App\Entities\Students\Student;
use App\Entities\Classes\ClassName;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageStudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_student_list_in_student_index_page()
    {
        $student = factory(Student::class)->create();

        $this->loginAsAdmin();
        $this->visitRoute('students.index');
        $this->see($student->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'nis'           => '123456',
            'nisn'          => '5678987655667',
            'name'          => 'Akhmad Herdian',
            'pob'           => 'Pelaihari',
            'dob'           => '1989-09-09',
            'gender_id'     => 1,
            'religion_id'   => 1,
            'phone'         => '085752669087',
            'email'         => 'herdian@example.net',
            'address'       => 'Jl. Martapura Lama Rt.6 Kec. Sungai Lulut Kab. Banjar',
            'father_name'   => 'Murjani',
            'father_phone'  => '098787656765',
            'mother_name'   => 'Nurjannah',
            'mother_phone'  => '098787656766',
            'wali_name'     => 'Zarkani',
            'wali_relation' => 'Paman',
            'wali_phone'    => '098787656788',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_student()
    {
        $this->loginAsAdmin();

        $className = $user = factory(ClassName::class)->create();

        $this->visitRoute('students.index');

        $this->click(__('student.create'));
        $this->seeRouteIs('students.create');

        $this->submitForm(__('student.create'), $this->getCreateFields([
            'class_id' => $className->id,
        ]));

        $this->seeRouteIs('students.show', Student::first());

        $this->seeInDatabase('students', $this->getCreateFields([
            'class_id' => $className->id,
        ]));

        $this->seeInDatabase('users', [
            'name'      => 'AKHMAD HERDIAN',
            'username'  => '123456',
            'email'     => 'herdian@example.net',
            'role_id'   => 3,
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function validate_student_name_is_required()
    {
        $this->loginAsAdmin();

        // name empty
        $this->post(route('students.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_name_is_not_more_than_60_characters()
    {
        $this->loginAsAdmin();

        // name 70 characters
        $this->post(route('students.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_address_is_not_more_than_255_characters()
    {
        $this->loginAsAdmin();

        // address 256 characters
        $this->post(route('students.store'), $this->getCreateFields([
            'address' => str_repeat('Long address', 50),
        ]));
        $this->assertSessionHasErrors('address');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'nis'           => '123458',
            'nisn'          => '5678987655667',
            'name'          => 'Heri Setiawan',
            'pob'           => 'Pelaihari',
            'dob'           => '1989-09-09',
            'gender_id'     => 1,
            'religion_id'   => 1,
            'phone'         => '085752669087',
            'email'         => 'heri@example.net',
            'address'       => 'Jl. Martapura Lama Rt.6 Kec. Sungai Lulut Kab. Banjar',
            'father_name'   => 'Murjani',
            'father_phone'  => '098787656765',
            'mother_name'   => 'Nurjannah',
            'mother_phone'  => '098787656766',
            'wali_name'     => 'Zarkani',
            'wali_relation' => 'Paman',
            'wali_phone'    => '098787656788',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_student()
    {
        $this->loginAsAdmin();

        $className = factory(ClassName::class)->create();
        $student = factory(Student::class)->create([
            'class_id' => $className->id,
            'name'     => 'Testing 123',
        ]);
        $user = factory(User::class)->create();
        $student->update(['login_id' => $user->id]);

        $this->visitRoute('students.show', $student);
        $this->click('edit-student-'.$student->id);
        $this->seeRouteIs('students.edit', $student);

        $this->submitForm(__('student.update'), $this->getEditFields());

        $this->seeRouteIs('students.show', $student);

        $this->seeInDatabase('students', $this->getEditFields([
            'id' => $student->id,
        ]));

        $this->seeInDatabase('users', [
            'name'     => 'HERI SETIAWAN',
            'username' => '123458',
            'email'    => 'heri@example.net',
        ]);
    }

    /** @test */
    public function validate_student_name_update_is_required()
    {
        $this->loginAsAdmin();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('students.update', $student), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsAdmin();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('students.update', $student), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_address_update_is_not_more_than_255_characters()
    {
        $this->loginAsAdmin();
        $student = factory(Student::class)->create(['name' => 'Testing 123']);

        // address 256 characters
        $this->patch(route('students.update', $student), $this->getEditFields([
            'address' => str_repeat('Long address', 50),
        ]));
        $this->assertSessionHasErrors('address');
    }

    /** @test */
    public function user_can_delete_a_student()
    {
        $this->loginAsAdmin();

        factory(Student::class)->create();
        $student = factory(Student::class)->create([
            'name' => 'Testing 123',
        ]);
        $user = factory(User::class)->create();
        $student->update(['login_id' => $user->id]);

        $this->visitRoute('students.edit', $student);
        $this->click('del-student-'.$student->id);
        $this->seeRouteIs('students.edit', [$student, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('students', [
            'id' => $student->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $student->login_id,
        ]);
    }
}
