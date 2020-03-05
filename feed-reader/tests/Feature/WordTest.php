<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class WordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testIndexFail(): void
    {
        $response = $this->get('/api/v1/words');

        $response->assertStatus(302);
    }
    
    /**
     * @return void
     */
    public function testExtractFail(): void
    {
        $response = $this->get('/api/v1/words/extract');

        $response->assertStatus(302);
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
            ->get('/api/v1/words');

        $response->assertStatus(200);
    }
    
    /**
     * @return void
     */
    public function testExtract(): void
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/api/v1/words/extract');

        $response->assertStatus(200);
    }
}
