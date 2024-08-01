<?php

namespace Tests\Feature;

use App\Models\Bank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BankControllerTest extends TestCase
{
    use RefreshDatabase;


        /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_a_bank()
    {
        $response = $this->postJson('/api/banks', [
            'name' => 'Test Bank',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test Bank']);
    }

    /** @test  list*/
    public function it_can_list_all_banks()
    {
        Bank::factory()->create(['name' => 'Test Bank']);

        $response = $this->getJson('/api/banks');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Test Bank']);
    }

    /** @test show */
    public function it_can_show_a_single_bank()
    {
        $bank = Bank::factory()->create(['name' => 'Test Bank']);

        $response = $this->getJson("/api/banks/{$bank->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Test Bank']);
    }

    /** @test  update*/
    public function it_can_update_a_bank()
    {
        $bank = Bank::factory()->create(['name' => 'Old Bank Name']);

        $response = $this->putJson("/api/banks/{$bank->id}", [
            'name' => 'New Bank Name',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Bank Name']);
    }

    /** @test  delete */
    public function it_can_delete_a_bank()
    {
        $bank = Bank::factory()->create();

        $response = $this->deleteJson("/api/banks/{$bank->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('banks', ['id' => $bank->id]);
    }
}

