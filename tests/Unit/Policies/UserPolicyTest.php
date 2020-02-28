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
        $admin = $this->createUser('admin');
        $this->assertTrue($admin->can('create', new User));
    }

    /** @test */
    public function user_can_view_user()
    {
        $admin = $this->createUser('admin');
        $user = factory(User::class)->create();
        $this->assertTrue($admin->can('view', $user));
    }

    /** @test */
    public function user_can_update_user()
    {
        $admin = $this->createUser('admin');
        $user = factory(User::class)->create();
        $this->assertTrue($admin->can('update', $user));
    }

    /** @test */
    public function user_can_delete_user()
    {
        $admin = $this->createUser('admin');
        $user = factory(User::class)->create();
        $this->assertTrue($admin->can('delete', $user));
    }
}
