<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Entities\Classes\ClassName;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClassNamePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_class_name()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new ClassName));
    }

    /** @test */
    public function user_can_view_class_name()
    {
        $user = $this->createUser();
        $className = factory(ClassName::class)->create();
        $this->assertTrue($user->can('view', $className));
    }

    /** @test */
    public function user_can_update_class_name()
    {
        $user = $this->createUser();
        $className = factory(ClassName::class)->create();
        $this->assertTrue($user->can('update', $className));
    }

    /** @test */
    public function user_can_delete_class_name()
    {
        $user = $this->createUser();
        $className = factory(ClassName::class)->create();
        $this->assertTrue($user->can('delete', $className));
    }
}
