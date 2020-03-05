<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testIndexAuthFail(): void
    {
        $response = $this->get('/api/v1/feed');

        $response->assertStatus(302);
    }

     /**
     * @return void
     */
    public function testIndeWithoutoAnyWords(): void
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/api/v1/feed');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * @return void
     */
    public function testIndex(): void
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/api/v1/words/extract');

        $response = $this
            ->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/api/v1/feed');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }


}
