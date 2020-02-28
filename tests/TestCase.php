<?php

namespace Tests;

use App\Entities\Users\User;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $baseUrl = 'http://localhost';

    protected function loginAsAdmin($userDataOverrides = [])
    {
        $user = $this->createUser('admin', $userDataOverrides);
        $this->actingAs($user);

        return $user;
    }

    protected function loginAsTeacher($userDataOverrides = [])
    {
        $user = $this->createUser('teacher', $userDataOverrides);
        $this->actingAs($user);

        return $user;
    }

    protected function loginAsStudent($userDataOverrides = [])
    {
        $user = $this->createUser('student', $userDataOverrides);
        $this->actingAs($user);

        return $user;
    }

    protected function createUser($role = 'admin', $userDataOverrides = [])
    {
        if ($role == 'admin') {
            $userDataOverrides = array_merge(['role_id' => 1], $userDataOverrides);
        }
        if ($role == 'teacher') {
            $userDataOverrides = array_merge(['role_id' => 2], $userDataOverrides);
        }
        if ($role == 'student') {
            $userDataOverrides = array_merge(['role_id' => 3], $userDataOverrides);
        }

        $user = factory(User::class)->create($userDataOverrides);

        return $user;
    }
}
