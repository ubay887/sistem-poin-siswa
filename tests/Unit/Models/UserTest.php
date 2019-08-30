<?php

namespace Tests\Unit\Models;

use App\User;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_name_link_attribute()
    {
        $user = factory(User::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $user->name, 'type' => __('user.user'),
        ]);
        $link = '<a href="'.route('users.show', $user).'"';
        $link .= ' title="'.$title.'">';
        $link .= $user->name;
        $link .= '</a>';

        $this->assertEquals($link, $user->name_link);
    }

    /** @test */
    public function a_user_has_belongs_to_creator_relation()
    {
        $user = factory(User::class)->make();

        $this->assertInstanceOf(User::class, $user->creator);
        $this->assertEquals($user->creator_id, $user->creator->id);
    }
}
