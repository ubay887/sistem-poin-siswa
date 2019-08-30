<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_user_list_in_user_index_page()
    {
        $user = factory(User::class)->create();

        $this->loginAsUser();
        $this->visitRoute('users.index');
        $this->see($user->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'User 1 name',
            'description' => 'User 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_user()
    {
        $this->loginAsUser();
        $this->visitRoute('users.index');

        $this->click(__('user.create'));
        $this->seeRouteIs('users.create');

        $this->submitForm(__('user.create'), $this->getCreateFields());

        $this->seeRouteIs('users.show', User::first());

        $this->seeInDatabase('users', $this->getCreateFields());
    }

    /** @test */
    public function validate_user_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('users.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('users.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('users.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'User 1 name',
            'description' => 'User 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_user()
    {
        $this->loginAsUser();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('users.show', $user);
        $this->click('edit-user-'.$user->id);
        $this->seeRouteIs('users.edit', $user);

        $this->submitForm(__('user.update'), $this->getEditFields());

        $this->seeRouteIs('users.show', $user);

        $this->seeInDatabase('users', $this->getEditFields([
            'id' => $user->id,
        ]));
    }

    /** @test */
    public function validate_user_name_update_is_required()
    {
        $this->loginAsUser();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('users.update', $user), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('users.update', $user), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_user_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $user = factory(User::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('users.update', $user), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_user()
    {
        $this->loginAsUser();
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
}
