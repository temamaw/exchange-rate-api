<?php

namespace Tests\Feature;

use App\Models\Bank;
use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExchangeRateControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_exchange_rate()
    {
        $bank = Bank::factory()->create();
        $currency = Currency::factory()->create();

        $response = $this->postJson('/api/exchange-rates', [
            'bank_id' => $bank->id,
            'currency_id' => $currency->id,
            'buying_rate' => 75.00,
            'selling_rate' => 77.00,
            'rate_date' => '2024-07-31',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['buying_rate' => 75.00]);
    }

    /** @test */
    public function it_can_list_all_exchange_rates()
    {
        $exchangeRate = ExchangeRate::factory()->create();

        $response = $this->getJson('/api/exchange-rates');

        $response->assertStatus(200)
            ->assertJsonFragment(['buying_rate' => $exchangeRate->buying_rate]);
    }

    /** @test */
    public function it_can_show_a_single_exchange_rate()
    {
        $exchangeRate = ExchangeRate::factory()->create();

        $response = $this->getJson("/api/exchange-rates/{$exchangeRate->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['buying_rate' => $exchangeRate->buying_rate]);
    }

    /** @test */
    public function it_can_update_an_exchange_rate()
    {
        $exchangeRate = ExchangeRate::factory()->create(['buying_rate' => 75.00]);

        $response = $this->putJson("/api/exchange-rates/{$exchangeRate->id}", [
            'buying_rate' => 76.00,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['buying_rate' => 76.00]);
    }

    /** @test */
    public function it_can_delete_an_exchange_rate()
    {
        $exchangeRate = ExchangeRate::factory()->create();

        $response = $this->deleteJson("/api/exchange-rates/{$exchangeRate->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('exchange_rates', ['id' => $exchangeRate->id]);
    }
}
