<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entities\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_user_list_in_user_index_page()
    {
        $user = factory(User::class)->create();

        $this->loginAsAdmin();
        $this->visitRoute('users.index');
        $this->see($user->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'     => 'Username',
            'username' => 'username_example',
            'email'    => 'example@mail.com',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_user()
    {
        $this->loginAsAdmin();
        $this->visitRoute('users.index');

        $this->click(__('user.create'));
        $this->seeRouteIs('users.create');

        $this->submitForm(__('user.create'), $this->getCreateFields());
        // dd(\DB::table('users')->get());
        $this->seeInDatabase('users', $this->getCreateFields([
            'name'    => 'USERNAME',
            'role_id' => 1,
        ]));
    }

    /** @test */
    public function validate_user_name_is_required()
    {
        $this->loginAsAdmin();

        // name empty
        $this->post(route('users.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_name_is_not_more_than_60_characters()
    {
        $this->loginAsAdmin();

        // name 70 characters
        $this->post(route('users.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'     => 'Username',
            'username' => 'username_example',
            'email'    => 'example@mail.com',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_user()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('users.show', $user);
        $this->click('edit-user-'.$user->id);
        $this->seeRouteIs('users.edit', $user);

        $this->submitForm(__('user.update'), $this->getEditFields());

        $this->seeRouteIs('users.show', $user);

        $this->seeInDatabase('users', $this->getEditFields([
            'id'   => $user->id,
            'name' => 'USERNAME',
        ]));
    }

    /** @test */
    public function validate_user_name_update_is_required()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('users.update', $user), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('users.update', $user), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function user_can_delete_a_user()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();
        factory(User::class)->create();

        $this->visitRoute('users.edit', $user);
        $this->click('del-user-'.$user->id);
        $this->seeRouteIs('users.edit', [$user, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('users', [
            'id' => $user->id,
        ]);
    }

    /** @test */
    public function admin_can_suspend_a_user()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create(['role_id' => 2]);

        $this->visit(route('users.show', $user));

        $this->seeInDatabase('users', [
            'id'        => $user->id,
            'is_active' => 1,
        ]);

        $this->seeElement('button', ['id' => 'status-user']);

        $this->press('status-user');

        $this->seeInDatabase('users', [
            'id'        => $user->id,
            'is_active' => 0,
        ]);
    }

    /** @test */
    public function admin_can_activate_a_suspended_user()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create([
            'role_id'   => 2,
            'is_active' => 0,
        ]);

        $this->visit(route('users.show', $user));

        $this->seeInDatabase('users', [
            'id'        => $user->id,
            'is_active' => 0,
        ]);

        $this->seeElement('button', ['id' => 'status-user']);

        $this->press('status-user');

        $this->seeInDatabase('users', [
            'id'        => $user->id,
            'is_active' => 1,
        ]);
    }
}
