<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\App\Services\School;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ManageSchoolTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_visit_school_page()
    {
        $this->loginAsUser();
        $this->visit(route('schools.page'));
        $this->seePageIs(route('schools.page'));
    }

    /** @test */
    public function admin_can_save_school_data()
    {
        $this->loginAsUser();
        $this->visit(route('schools.page'));

        $this->submitForm(__('school.update'), [
            'school_name'     => 'SMK 1 Example',
            'school_address'  => 'Jl. Gagas Permai',
            'school_district' => 'Kabupaten Tanah Laut',
            'school_province' => 'Kalimantan Selatan',
            'school_pos'      => '70814',
            'school_phone'    => '05121213',
            'school_email'    => 'smkexample@mail.com',
            'school_web'      => 'www.smkexample.com',
        ]);

        $this->seePageIs(route('schools.page'));
        $this->see(__('school.updated'));

        $this->seeInDatabase('schools', [
            'key'   => 'school_name',
            'value' => 'SMK 1 Example',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_address',
            'value' => 'Jl. Gagas Permai',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_district',
            'value' => 'Kabupaten Tanah Laut',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_province',
            'value' => 'Kalimantan Selatan',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_pos',
            'value' => '70814',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_phone',
            'value' => '05121213',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_email',
            'value' => 'smkexample@mail.com',
        ]);

        $this->seeInDatabase('schools', [
            'key'   => 'school_web',
            'value' => 'www.smkexample.com',
        ]);
    }

    /** @test */
    public function user_can_upload_a_company_logo()
    {
        $this->loginAsUser();

        $storage = config('filesystems.default');
        Storage::fake($storage);

        $this->visit(route('schools.page'));

        $this->see(__('school.upload_logo'));
        $this->attach(public_path('images/sample_logo.png'), 'search_logo');
        $this->press('upload_logo');

        $this->seeRouteIs('schools.page');
        $this->seeText(__('school.logo_uploaded'));

        $school = School::get('school_logo');

        Storage::disk($storage)->assertExists('images/'.$school);
    }
}
