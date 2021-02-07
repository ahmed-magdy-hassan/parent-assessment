<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProviderUserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_the_all_users_data()
    {
        $response = $this->get(route('provider.users.index'));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['users'])
            ->assertJsonFragment(
                [
                    "parentEmail" => "parent1@parent.eu",
                ]
            )->assertJsonFragment(
                [
                    "email" => "parent2@parent.eu",
                ]
            );
    }

    /**
     * @test
     */
    public function can_filter_by_provider()
    {
        $response = $this->get(route('provider.users.index', [
            'provider' => 'DataProviderY'
        ]));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['users'])
            ->assertJsonFragment([
                'email' => "parent2@parent.eu"
            ])
            ->assertJsonMissing([
                "parentEmail" => "parent1@parent.eu",
            ]);
    }

    /**
     * @test
     */
    public function can_not_filter_by_wrong_provider()
    {
        $response = $this->get(route('provider.users.index', [
            'provider' => 'provider123'
        ]));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['users'])
            ->assertJsonCount(0, 'users');
    }

    /**
     * @test
     */
    public function can_be_filtered_by_currency()
    {
        $response = $this->get(route('api.users'));
        $filtered_response = $this->get(
            route('api.users', [
                'currency' => 'USD'
            ])
        );

        // assert
        $this->assertLessThanOrEqual(
            count($response['data']),
            count($filtered_response['data'])
        );
    }

    /**
     * @test
     */
    public function can_be_filtered_by_status_code()
    {
        $response = $this->get(route('api.users'));
        $filtered_response = $this->get(
            route('api.users', [
                'status' => 'authorized'
            ])
        );

        // assert
        $this->assertLessThanOrEqual(
            count($response['data']),
            count($filtered_response['data'])
        );
    }
}
