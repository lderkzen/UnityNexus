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

class FormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private static $USER = null;

    protected function setUp(): void
    {
        parent::setUp();

        self::$USER = User::factory()->createOne();
    }

    public function test_can_show_edit_page()
    {
        $channel_type = ChannelType::factory()->createOne([
            'id' => 0
        ]);
        $channel = Channel::factory()->createOne([
            'type_id' => $channel_type->id
        ]);
        $supergroup = Supergroup::factory()->createOne();
        $group = Group::factory()->createOne([
            'supergroup_id' => $supergroup->id,
            'channel_id' => $channel->id
        ]);
        $question_type = QuestionType::factory()->createOne();
        $questions = Question::factory(10)->create([
            'group_id' => $group->id,
            'type_id' => $question_type->id
        ])->sortBy('position');

        $response = $this->actingAs(self::$USER)
            ->get('/groups/' . $group->id . '/edit');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Groups/CreateEdit')
                ->has('group', fn($page) => $page
                    ->has('channel', fn($page) => $page
                        ->where('id', strval($channel->id))
                        ->etc())
                    ->has('form', 10)
                    ->has('form.1', fn($page) => $page
                        ->where('position', $questions->slice(1, 1)->first()->position)
                        ->etc())
                    ->has('form.4', fn($page) => $page
                        ->where('position', $questions->slice(4, 1)->first()->position)
                        ->etc())
                    ->has('form.7', fn($page) => $page
                        ->where('position', $questions->slice(7, 1)->first()->position)
                        ->etc())
                    ->etc()));
    }
}
