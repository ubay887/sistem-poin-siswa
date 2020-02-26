<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entities\Classes\ClassName;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageClassNameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_class_name_list_in_class_name_index_page()
    {
        $className = factory(ClassName::class)->create();

        $this->loginAsUser();
        $this->visitRoute('class_names.index');
        $this->see($className->name);
    }

    /** @test */
    public function user_can_create_a_class_name()
    {
        $this->loginAsUser();
        $this->visitRoute('class_names.index');

        $this->click(__('class_name.create'));
        $this->seeRouteIs('class_names.index', ['action' => 'create']);

        $this->submitForm(__('class_name.create'), [
            'name'        => 'ClassName 1 name',
            'description' => 'ClassName 1 description',
        ]);

        $this->seeRouteIs('class_names.index');

        $this->seeInDatabase('class_names', [
            'name'        => 'ClassName 1 name',
            'description' => 'ClassName 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'ClassName 1 name',
            'description' => 'ClassName 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_class_name_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('class_names.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_class_name_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('class_names.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_class_name_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('class_names.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_class_name_within_search_query()
    {
        $this->loginAsUser();
        $className = factory(ClassName::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('class_names.index', ['q' => '123']);
        $this->click('edit-class_name-'.$className->id);
        $this->seeRouteIs('class_names.index', ['action' => 'edit', 'id' => $className->id, 'q' => '123']);

        $this->submitForm(__('class_name.update'), [
            'name'        => 'ClassName 1 name',
            'description' => 'ClassName 1 description',
        ]);

        $this->seeRouteIs('class_names.index', ['q' => '123']);

        $this->seeInDatabase('class_names', [
            'name'        => 'ClassName 1 name',
            'description' => 'ClassName 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'ClassName 1 name',
            'description' => 'ClassName 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_class_name_name_update_is_required()
    {
        $this->loginAsUser();
        $class_name = factory(ClassName::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('class_names.update', $class_name), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_class_name_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $class_name = factory(ClassName::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('class_names.update', $class_name), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_class_name_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $class_name = factory(ClassName::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('class_names.update', $class_name), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_class_name()
    {
        $this->loginAsUser();
        $className = factory(ClassName::class)->create();
        factory(ClassName::class)->create();

        $this->visitRoute('class_names.index', ['action' => 'edit', 'id' => $className->id]);
        $this->click('del-class_name-'.$className->id);
        $this->seeRouteIs('class_names.index', ['action' => 'delete', 'id' => $className->id]);

        $this->seeInDatabase('class_names', [
            'id' => $className->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('class_names', [
            'id' => $className->id,
        ]);
    }
}
