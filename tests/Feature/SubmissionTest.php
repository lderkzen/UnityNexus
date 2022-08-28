<?php

namespace Tests\Feature;

use App\Models\User;
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
}
