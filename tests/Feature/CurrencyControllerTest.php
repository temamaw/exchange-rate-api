<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;   
use App\Models\Currency;
  
    class CurrencyControllerTest extends TestCase
    {
        use RefreshDatabase;

 
        /** @test */
        public function it_can_create_a_currency()
        {
            $response = $this->postJson('/api/currencies', [
                'code' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
            ]);
    
            $response->assertStatus(201)
                ->assertJsonFragment(['code' => 'USD']);
        }
    
        /** @test */
        public function it_can_list_all_currencies()
        {
            Currency::factory()->create(['name' => 'US Dollar']);
    
            $response = $this->getJson('/api/currencies');
    
            $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'US Dollar']);
        }
    
        /** @test */
        public function it_can_show_a_single_currency()
        {
            $currency = Currency::factory()->create(['name' => 'US Dollar']);
    
            $response = $this->getJson("/api/currencies/{$currency->id}");
    
            $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'US Dollar']);
        }
    
        /** @test */
        public function it_can_update_a_currency()
        {
            $currency = Currency::factory()->create(['name' => 'Old Name']);
    
            $response = $this->putJson("/api/currencies/{$currency->id}", [
                'name' => 'New Name',
            ]);
    
            $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'New Name']);
        }
    
        /** @test */
        public function it_can_delete_a_currency()
        {
            $currency = Currency::factory()->create();
    
            $response = $this->deleteJson("/api/currencies/{$currency->id}");
    
            $response->assertStatus(204);
            $this->assertDatabaseMissing('currencies', ['id' => $currency->id]);
        }
    }
    