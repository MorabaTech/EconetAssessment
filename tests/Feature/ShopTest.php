<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_shop()
    {
        $response = $this->postJson('/api/shop', [
            'name' => 'Econet Masasa',
            'area_id' => 1,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'Success',
                 'message'=>'Shop created Successfully'
            ]);
    }

    /** @test */
    public function it_can_get_a_shop_by_id()
    {
        $shop = factory(\App\Shop::class)->create();

        $response = $this->getJson('/api/' . $shop->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $shop->id,
                'shop_name' => $shop->name,
            ]);
    }

    /** @test */
    public function it_can_create_an_area()
    {
        $response = $this->postJson('/api/area', [
            'area_name' => 'My Area',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'id' => 1,
                'area_name' => 'HARARE CBD',
            ]);
    }
}
