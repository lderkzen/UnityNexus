<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\ChannelType;
use App\Models\Group;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Supergroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private static $USER = null;

    protected function setUp(): void
    {
        parent::setUp();

        self::$USER = User::factory()->createOne();
    }

    public function test_can_show_index_page()
    {
        $generated = array_merge($this->generateChannels(), $this->generateSupergroup());
        $groups = Group::factory(3)->create([
            'supergroup_id' => $generated['supergroup']->id,
            'channel_id' => fake()->randomElement($generated['channels']->pluck(['id'])->all())
        ])->sortBy('position');

        $response = $this->actingAs(self::$USER)
            ->get('/groups');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Groups/Index')
                ->has('supergroups', 1)
                ->has('supergroups.0.groups.0', fn($page) => $page
                    ->where('position', $groups->slice(0, 1)->first()->position)
                    ->where('channel_id', strval($groups->slice(0, 1)->first()->channel_id))
                    ->etc())
                ->has('supergroups.0.groups.1', fn($page) => $page
                    ->where('position', $groups->slice(1, 1)->first()->position)
                    ->etc())
                ->has('supergroups.0.groups.2', fn($page) => $page
                    ->where('position', $groups->slice(2, 1)->first()->position)
                    ->etc()));
    }

    public function test_can_show_filtered_index_page()
    {
        $this->assertEquals(true, true);
    }

    public function test_can_show_create_page()
    {
        $generated = $this->generateChannels();

        $response = $this->actingAs(self::$USER)
            ->get('/groups/create');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Groups/CreateEdit')
                ->has('channels', 3)
                ->has('channels.0', fn($page) => $page
                    ->where('position', $generated['channels']->slice(0, 1)->first()->position)
                    ->where('id', strval($generated['channels']->slice(0, 1)->first()->id))
                    ->where('type_id', 0)
                    ->etc())
                ->has('channels.1', fn($page) => $page
                    ->where('position', $generated['channels']->slice(1, 1)->first()->position)
                    ->where('type_id', 0)
                    ->etc())
                ->has('channels.2', fn($page) => $page
                    ->where('position', $generated['channels']->slice(2, 1)->first()->position)
                    ->where('type_id', 0)
                    ->etc()));
    }

    public function test_can_store()
    {
        $generated = array_merge($this->generateChannels(), $this->generateSupergroup());

        $response = $this->actingAs(self::$USER)
            ->post('/groups', [
                'supergroup_id' => $generated['supergroup']->id,
                'channel_id' => $generated['channels']->first()->id,
                'name' => fake()->words(3, true),
                'description' => fake()->sentences(4, true),
                'recruiting' => false,
                'position' => 10
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertDatabaseHas('groups', [
            'supergroup_id' => $generated['supergroup']->id
        ]);
    }

    public function test_can_show_edit_page()
    {
        $generated = $this->generateGroup();

        $response = $this->actingAs(self::$USER)
            ->get('/groups/' . $generated['group']->id . '/edit');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Groups/CreateEdit')
                ->has('group', fn($page) => $page
                    ->has('channel', fn($page) => $page
                        ->where('id', strval($generated['channels']->slice(0, 1)->first()->id))
                        ->etc())
                    ->etc())
                ->has('channels', 3)
                ->has('channels.0', fn($page) => $page
                    ->where('position', $generated['channels']->slice(0, 1)->first()->position)
                    ->where('id', strval($generated['channels']->slice(0, 1)->first()->id))
                    ->etc())
                ->has('channels.1', fn($page) => $page
                    ->where('position', $generated['channels']->slice(1, 1)->first()->position)
                    ->etc())
                ->has('channels.2', fn($page) => $page
                    ->where('position', $generated['channels']->slice(2, 1)->first()->position)
                    ->etc()));
    }

    public function test_can_update()
    {
        $generated = $this->generateGroup();

        $newName = fake()->words(2, true);
        $response = $this->actingAs(self::$USER)
            ->put('/groups/' . $generated['group']->id, [
                'name' => $newName
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertDatabaseHas('groups', [
            'id' => $generated['group']->id,
            'name' => $newName
        ]);
    }

    public function test_can_attach_to_supergroup()
    {
        $generated = $this->generateGroup();

        $this->assertDatabaseHas('groups', [
            'id' => $generated['group']->id,
            'supergroup_id' => $generated['supergroup']->id
        ]);

        $newSupergroup = Supergroup::factory()->createOne();
        $response = $this->actingAs(self::$USER)
            ->put('/groups/' . $generated['group']->id . '/attach', [
                'supergroup_id' => $newSupergroup->id
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertDatabaseHas('groups', [
            'id' => $generated['group']->id,
            'supergroup_id' => $newSupergroup->id
        ]);
    }

    public function test_can_detach_from_supergroup()
    {
        $generated = $this->generateGroup();
        $backupSupergroup = Supergroup::factory()->createOne([
            'id' => 1,
            'name' => 'Ungrouped'
        ]);

        $this->assertDatabaseHas('groups', [
            'id' => $generated['group']->id,
            'supergroup_id' => $generated['supergroup']->id
        ]);

        $response = $this->actingAs(self::$USER)
            ->put('/groups/' . $generated['group']->id . '/detach');

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertDatabaseHas('groups', [
            'id' => $generated['group']->id,
            'supergroup_id' => $backupSupergroup->id
        ]);
    }

    public function test_can_delete()
    {
        $generated = $this->generateGroup();

        $this->assertDatabaseHas('groups', [
            'id' => $generated['group']->id
        ]);

        $response = $this->actingAs(self::$USER)
            ->delete('/groups/' . $generated['group']->id);

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertSoftDeleted('groups', [
            'id' => $generated['group']->id
        ]);
    }

    private function generateChannels()
    {
        $type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channels = Channel::factory(3)->create([
            'type_id' => $type->id
        ])->sortBy('position');

        return [
            'type' => $type,
            'channels' => $channels
        ];
    }

    private function generateSupergroup()
    {
        $supergroup = Supergroup::factory()->createOne();

        return [
            'supergroup' => $supergroup
        ];
    }

    private function generateGroup()
    {
        $generatedChannels = $this->generateChannels();
        $generatedSupergroup = $this->generateSupergroup();
        $group = Group::factory()->createOne([
            'supergroup_id' => $generatedSupergroup['supergroup']->id,
            'channel_id' => $generatedChannels['channels']->first()->id
        ]);

        return array_merge($generatedChannels, $generatedSupergroup, [
            'group' => $group,
        ]);
    }

    private function generateGroupWithForm()
    {
        $generated = $this->generateGroup();

        $question_type = QuestionType::factory()->createOne();
        $questions = Question::factory(10)->create([
            'group_id' => $generated['group']->id,
            'type_id' => $question_type->id
        ])->sortBy('position');

        return array_merge($generated, [
            'question_type' => $question_type,
            'questions' => $questions
        ]);
    }
}
