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
        $admin = $this->createUser('admin');
        $this->assertTrue($admin->can('create', new ClassName));
    }

    /** @test */
    public function user_can_view_class_name()
    {
        $admin = $this->createUser('admin');
        $className = factory(ClassName::class)->create();
        $this->assertTrue($admin->can('view', $className));
    }

    /** @test */
    public function user_can_update_class_name()
    {
        $admin = $this->createUser('admin');
        $className = factory(ClassName::class)->create();
        $this->assertTrue($admin->can('update', $className));
    }

    /** @test */
    public function user_can_delete_class_name()
    {
        $admin = $this->createUser('admin');
        $className = factory(ClassName::class)->create();
        $this->assertTrue($admin->can('delete', $className));
    }
}
