<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\ApplicationSubmission;
use App\Models\Channel;
use App\Models\ChannelType;
use App\Models\Group;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Status;
use App\Models\Supergroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmissionTest extends TestCase
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
        $response = $this->actingAs(self::$USER)
            ->get('/submissions');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Submissions/Index')
                ->has('submissions'));
    }

    public function test_can_show_details_page()
    {
        $generated = $this->generateSubmittedApplication();

        $this->assertDatabaseHas('application_submissions', [
            'id' => $generated['submission']->id
        ]);

        $response = $this->actingAs(self::$USER)
            ->get('/submissions/' . $generated['submission']->id);

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Submissions/Details')
                ->has('submission', fn($page) => $page
                    ->has('applicant')
                    ->has('status')
                    ->has('answers', 10)
                    ->etc())
                ->etc());
    }

    public function test_can_show_apply_page()
    {
        $generated = $this->generateGroupWithForm();

        $response = $this->actingAs(self::$USER)
            ->get('/groups/' . $generated['group']->id . '/apply');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Submissions/CreateEdit')
                ->has('group', fn($page) => $page
                    ->has('form', 10)
                    ->has('form.0', fn($page) => $page
                        ->where('position', $generated['questions']->slice(0, 1)->first()->position)
                        ->etc())
                    ->has('form.3', fn($page) => $page
                        ->where('position', $generated['questions']->slice(3, 1)->first()->position)
                        ->etc())
                    ->has('form.9', fn($page) => $page
                        ->where('position', $generated['questions']->slice(9, 1)->first()->position)
                        ->etc())
                    ->etc()));
    }

    public function test_can_store()
    {
        $generated = $this->generateGroupWithForm();

        $response = $this->actingAs(self::$USER)
            ->post('/groups/' . $generated['group']->id . '/apply', [
                'public' => fake()->boolean(),
                'age' => fake()->numberBetween(18, 50),
                'location' => fake()->country(),
                'status_id' => $generated['status']->id,
                'answers' => $generated['questions']->map(fn($question) => [
                    'question_id' => $question->id,
                    'answer' => fake()->sentence()
                ])->all()
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/submissions/' . ApplicationSubmission::all()->first()->id);

        $this->assertDatabaseCount('application_submissions', 1);
        $this->assertDatabaseCount('answers', 10);
    }

    public function test_can_show_edit_application_page()
    {
        $generated = $this->generateSubmittedApplication();

        $response = $this->actingAs(self::$USER)
            ->get('/submissions/' . $generated['submission']->id . '/edit');

        $response->assertStatus(200)
            ->assertInertia(fn($page) => $page
                ->component('Submissions/CreateEdit')
                ->has('group')
                ->has('form', 10)
                ->has('form.0', fn($page) => $page
                    ->has('answer')
                    ->has('feedback', 0)
                    ->where('position', $generated['questions']->slice(0, 1)->first()->position)
                    ->etc())
                ->has('form.3', fn($page) => $page
                    ->has('answer')
                    ->has('feedback', 0)
                    ->where('position', $generated['questions']->slice(3, 1)->first()->position)
                    ->etc())
                ->has('form.9', fn($page) => $page
                    ->has('answer')
                    ->has('feedback', 0)
                    ->where('position', $generated['questions']->slice(9, 1)->first()->position)
                    ->etc())
                ->etc());
    }

    public function test_cannot_update_when_status_is_not_refinement()
    {
        $generated = $this->generateSubmittedApplication();

        $new_location = fake()->country();
        $new_last_answer = fake()->sentence();

        $response = $this->actingAs(self::$USER)
            ->put('/submissions/' . $generated['submission']->id, [
                'location' => $new_location,
                'answers' => [
                    ['question_id' => Question::all()->last()->id, 'answer' => $new_last_answer]
                ]
            ]);

        $response->assertStatus(500);
    }

    public function test_can_update_public_attribute_if_status_is_not_refinement()
    {
        $generated = $this->generateSubmittedApplication();

        $new_public = !$generated['submission']->public;

        $response = $this->actingAs(self::$USER)
            ->put('/submissions/' . $generated['submission']->id, [
                'public' => $new_public,
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/submissions/' . ApplicationSubmission::all()->first()->id);

        $this->assertEquals($new_public, ApplicationSubmission::find($generated['submission']->id)->public);
    }

    public function test_can_update_if_status_is_refinement()
    {
        $generated = $this->generateSubmittedApplication();
        $generated['status']->status = 'REFINEMENT';
        $generated['status']->save();

        $new_location = fake()->country();
        $new_last_answer = fake()->sentence();

        $response = $this->actingAs(self::$USER)
            ->put('/submissions/' . $generated['submission']->id, [
                'location' => $new_location,
                'answers' => [
                    ['question_id' => Question::all()->last()->id, 'answer' => $new_last_answer]
                ]
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/submissions/' . $generated['submission']->id);

        $this->assertEquals($new_location, ApplicationSubmission::find($generated['submission']->id)->location);
        $this->assertEquals($new_last_answer, Answer::all()->last()->answer);
        $this->assertEquals(Status::where('status', '=', 'PENDING')->first()->id, ApplicationSubmission::find($generated['submission']->id)->status_id);
    }

    public function test_can_transfer() {
        $generated = $this->generateSubmittedApplication();
        $newGroup = Group::factory()->createOne([
            'supergroup_id' => $generated['supergroup']->id
        ]);

        $response = $this->actingAs(self::$USER)
            ->put('/submissions/' . $generated['submission']->id . '/transfer', [
                'group_id' => $newGroup->id,
            ]);

        $response->assertStatus(302)
            ->assertRedirect();

        $this->assertEquals($newGroup->id, ApplicationSubmission::find($generated['submission']->id)->group_id);
    }

    private function generateGroup()
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

        return [
            'type' => $type,
            'channel' => $channel,
            'supergroup' => $supergroup,
            'group' => $group,
        ];
    }

    private function generateGroupWithForm()
    {
        $generated = $this->generateGroup();

        $question_type = QuestionType::factory()->createOne();
        $questions = Question::factory(10)->create([
            'group_id' => $generated['group']->id,
            'type_id' => $question_type->id
        ])->sortBy('position');
        $status = Status::factory()->createOne();
        Status::factory()->createOne([
            'status' => 'PENDING'
        ]);

        return array_merge($generated, [
            'question_type' => $question_type,
            'questions' => $questions,
            'status' => $status
        ]);
    }

    private function generateSubmittedApplication()
    {
        $generated = $this->generateGroupWithForm();

        $submission = ApplicationSubmission::factory()->createOne([
            'group_id' => $generated['group']->id,
            'applicant_id' => self::$USER->id,
            'status_id' => $generated['status']->id
        ]);
        $answers = new Collection();
        foreach ($generated['questions'] as $question) {
            $answers->push(Answer::factory()->createOne([
                'application_submission_id' => $submission->id,
                'question_id' => $question->id,
                'question' => $question->question
            ]));
        }

        return array_merge($generated, [
            'submission' => $submission,
            'answers' => $answers
        ]);
    }
}
