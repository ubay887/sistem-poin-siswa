<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Entities\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_user()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new User));
    }

    /** @test */
    public function user_can_view_user()
    {
        $user = $this->createUser();
        $user = factory(User::class)->create();
        $this->assertTrue($user->can('view', $user));
    }

    /** @test */
    public function user_can_update_user()
    {
        $user = $this->createUser();
        $user = factory(User::class)->create();
        $this->assertTrue($user->can('update', $user));
    }

    /** @test */
    public function user_can_delete_user()
    {
        $user = $this->createUser();
        $user = factory(User::class)->create();
        $this->assertTrue($user->can('delete', $user));
    }
}
