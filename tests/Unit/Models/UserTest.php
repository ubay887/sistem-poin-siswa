<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Entities\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
