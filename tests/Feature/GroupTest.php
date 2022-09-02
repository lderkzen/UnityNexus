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
        $type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channels = Channel::factory(10)->create([
            'type_id' => $type->id
        ]);
        $supergroup = Supergroup::factory()->createOne();
        $groups = Group::factory(3)->create([
            'supergroup_id' => $supergroup->id,
            'channel_id' => fake()->randomElement($channels->pluck(['id'])->all())
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

    public function test_can_show_create_page()
    {
        $type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channels = Channel::factory(10)->create([
            'type_id' => $type->id
        ])->sortBy('position');

        $response = $this->actingAs(self::$USER)
            ->get('/groups/create');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Groups/CreateEdit')
                ->has('channels', 10)
                ->has('channels.0', fn($page) => $page
                    ->where('position', $channels->slice(0, 1)->first()->position)
                    ->where('id', strval($channels->slice(0, 1)->first()->id))
                    ->where('type_id', 0)
                    ->etc())
                ->has('channels.2', fn($page) => $page
                    ->where('position', $channels->slice(2, 1)->first()->position)
                    ->where('type_id', 0)
                    ->etc())
                ->has('channels.8', fn($page) => $page
                    ->where('position', $channels->slice(8, 1)->first()->position)
                    ->where('type_id', 0)
                    ->etc()));
    }

    public function test_can_store()
    {
        $type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channel = Channel::factory()->createOne([
            'type_id' => $type->id
        ]);
        $supergroup = Supergroup::factory()->createOne();

        $response = $this->actingAs(self::$USER)
            ->post('/groups', [
                'supergroup_id' => $supergroup->id,
                'channel_id' => $channel->id,
                'name' => fake()->words(3, true),
                'description' => fake()->sentences(4, true),
                'recruiting' => false,
                'position' => 10
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertDatabaseHas('groups', [
            'supergroup_id' => $supergroup->id
        ]);
    }

    public function test_can_show_edit_page()
    {
        $channel_type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channels = Channel::factory(3)->create([
            'type_id' => $channel_type->id
        ])->sortBy('position');
        $supergroup = Supergroup::factory()->createOne();
        $group = Group::factory()->createOne([
            'supergroup_id' => $supergroup->id,
            'channel_id' => $channels->slice(0, 1)->first()->id
        ]);

        $response = $this->actingAs(self::$USER)
            ->get('/groups/' . $group->id . '/edit');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Groups/CreateEdit')
                ->has('group', fn($page) => $page
                    ->has('channel', fn($page) => $page
                        ->where('id', strval($channels->slice(0, 1)->first()->id))
                        ->etc())
                    ->etc())
                ->has('channels', 3)
                ->has('channels.0', fn($page) => $page
                    ->where('position', $channels->slice(0, 1)->first()->position)
                    ->where('id', strval($channels->slice(0, 1)->first()->id))
                    ->etc())
                ->has('channels.1', fn($page) => $page
                    ->where('position', $channels->slice(1, 1)->first()->position)
                    ->etc())
                ->has('channels.2', fn($page) => $page
                    ->where('position', $channels->slice(2, 1)->first()->position)
                    ->etc()));
    }

    public function test_can_update()
    {
        $type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channel = Channel::factory()->createOne([
            'type_id' => $type->id
        ]);
        $supergroup = Supergroup::factory()->createOne();
        $group = Group::factory()->createOne([
            'supergroup_id' => $supergroup->id,
            'channel_id' => $channel->id
        ]);

        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'name' => $group->name
        ]);

        $newName = fake()->words(2, true);
        $response = $this->actingAs(self::$USER)
            ->put('/groups/' . $group->id, [
                'name' => $newName
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/groups');

        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'name' => $newName
        ]);
    }
}
