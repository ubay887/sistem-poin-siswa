<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\App\Services\Option;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ManageOptionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_visit_option_page()
    {
        $this->loginAsAdmin();
        $this->visit(route('options.page'));
        $this->seePageIs(route('options.page'));
    }

    /** @test */
    public function admin_can_save_option_data()
    {
        $this->loginAsAdmin();
        $this->visit(route('options.page'));

        $this->submitForm(__('option.update'), [
            'option_name'     => 'SMK 1 Example',
            'option_address'  => 'Jl. Gagas Permai',
            'option_district' => 'Kabupaten Tanah Laut',
            'option_province' => 'Kalimantan Selatan',
            'option_pos'      => '70814',
            'option_phone'    => '05121213',
            'option_email'    => 'smkexample@mail.com',
            'option_web'      => 'www.smkexample.com',
        ]);

        $this->seePageIs(route('options.page'));
        $this->see(__('option.updated'));

        $this->seeInDatabase('site_options', [
            'key'   => 'option_name',
            'value' => 'SMK 1 Example',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_address',
            'value' => 'Jl. Gagas Permai',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_district',
            'value' => 'Kabupaten Tanah Laut',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_province',
            'value' => 'Kalimantan Selatan',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_pos',
            'value' => '70814',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_phone',
            'value' => '05121213',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_email',
            'value' => 'smkexample@mail.com',
        ]);

        $this->seeInDatabase('site_options', [
            'key'   => 'option_web',
            'value' => 'www.smkexample.com',
        ]);
    }

    /** @test */
    public function user_can_upload_a_company_logo()
    {
        $this->loginAsAdmin();

        $storage = config('filesystems.default');
        Storage::fake($storage);

        $this->visit(route('options.page'));

        $this->see(__('option.upload_logo'));
        $this->attach(public_path('images/sample_logo.png'), 'search_logo');
        $this->press('upload_logo');

        $this->seeRouteIs('options.page');
        $this->seeText(__('option.logo_uploaded'));

        $option = Option::get('option_logo');

        Storage::disk($storage)->assertExists('images/'.$option);
    }
}
