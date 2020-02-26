<?php

namespace Tests;

use App\Entities\Users\User;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $baseUrl = 'http://localhost';

    protected function loginAsUser()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        return $user;
    }

    protected function createUser()
    {
        return factory(User::class)->create();
    }
}
