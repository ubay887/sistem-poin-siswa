<?php

namespace Tests\Feature;

use App\School;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ManageSchoolTest extends TestCase
{
    use DatabaseMigrations;

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Nama Sekolah ABC',
            'address'     => 'Alamat Lengkap Sekolah',
            'district'    => 'Kabupaten Sekolah',
            'province'    => 'Provinsi Sekolah',
            'pos'         => '12345',
            'phone'       => '123456789012',
            'email'       => 'Email Sekolah',
            'web'         => 'Website Sekolah',
            'description' => 'Deskripsi Sekolah',
        ], $overrides);
    }

    /** @test */
    public function user_can_input_school_data()
    {
        $this->loginAsUser();
        $this->visitRoute('schools.create');

        $this->dontSee(__('app.delete'));
        $this->dontSee(__('school.update'));
        $this->see(__('school.create'));

        $this->submitForm(__('school.create'), $this->getCreateFields());

        $this->seeRouteIs('schools.create');
        $this->seeText(__('school.created'));

        $this->seeInDatabase('schools', $this->getCreateFields());
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Nama Sekolah Baru',
            'address'     => 'Alamat Lengkap Sekolah',
            'district'    => 'Kabupaten Sekolah',
            'province'    => 'Provinsi Sekolah',
            'pos'         => '12345',
            'phone'       => '123456789012',
            'email'       => 'Email Sekolah',
            'web'         => 'Website Sekolah',
            'description' => 'Deskripsi Sekolah',
        ], $overrides);
    }

    /** @test */
    public function user_can_update_school_data()
    {
        $user = $this->loginAsUser();
        $school = factory(School::class)->create([
            'name'       => 'Example School',
            'creator_id' => $user->id,
        ]);

        $this->visitRoute('schools.create');

        $this->see(__('app.delete'));
        $this->see(__('school.update'));

        $this->submitForm(__('school.update'), $this->getEditFields());
        $this->seeRouteIs('schools.create');
        $this->seeText(__('school.updated'));

        $this->seeInDatabase('schools', $this->getEditFields([
            'id' => $school->id,
        ]));
    }

    /** @test */
    public function user_can_delete_school_data()
    {
        $this->loginAsUser();
        $school = factory(School::class)->create();

        $this->visitRoute('schools.create');

        $this->see(__('app.delete'));

        $this->submitForm(__('app.delete'));
        $this->seeRouteIs('schools.create');
        $this->seeText(__('school.deleted'));

        $this->dontSeeInDatabase('schools', [
            'id' => $school->id,
        ]);
    }

    /** @test */
    public function user_can_upload_a_company_logo()
    {
        $this->loginAsUser();

        $storage = config('filesystems.default');
        Storage::fake($storage);

        $school = factory(School::class)->create();

        $this->visit(route('schools.create'));

        $this->see(__('school.upload_logo'));
        $this->attach(public_path('sampel_logo.png'), 'search_logo');
        $this->press('upload_logo');

        $this->seeRouteIs('schools.create');
        $this->seeText(__('school.logo_uploaded'));

        Storage::disk($storage)->assertExists('images/'.$school->fresh()->logo);
    }

    /** @test */
    public function user_can_delete_a_company_logo()
    {
        $this->loginAsUser();

        $storage = config('filesystems.default');
        Storage::fake($storage);

        $school = factory(School::class)->create();

        $this->visit(route('schools.create'));

        $this->see(__('school.upload_logo'));
        $this->attach(public_path('sampel_logo.png'), 'search_logo');
        $this->press('upload_logo');

        $this->seeRouteIs('schools.create');

        Storage::disk($storage)->assertExists('images/'.$school->fresh()->logo);

        $this->press('delete_logo');
        $this->seePageIs(route('schools.create'));

        $this->seeText(__('school.logo_deleted'));

        Storage::disk($storage)->assertMissing($school->fresh()->logo);
    }
}
