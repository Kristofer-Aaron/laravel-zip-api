<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\City;
use App\Models\County;

class CityApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Set up an in-memory database for testing.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Use SQLite in-memory database
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');

        // Run migrations
        $this->artisan('migrate');
    }

    /** @test */
    public function it_can_list_cities()
    {
        $county = County::create(['name' => 'Pest']);
        City::create(['zip' => '1000', 'name' => 'Budapest', 'county_id' => $county->id]);

        $response = $this->getJson('/api/cities');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Budapest', 'zip' => '1000']);
    }

    /** @test */
    public function it_can_show_a_city()
    {
        $county = County::create(['name' => 'Pest']);
        $city = City::create(['zip' => '2000', 'name' => 'Szentendre', 'county_id' => $county->id]);

        $response = $this->getJson("/api/cities/{$city->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Szentendre', 'zip' => '2000']);
    }

    /** @test */
    public function it_can_create_a_city()
    {
        $data = [
            'zip' => '3000',
            'name' => 'Esztergom',
            'county' => 'Komárom-Esztergom'
        ];

        $response = $this->postJson('/api/cities', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Esztergom', 'zip' => '3000'])
                 ->assertJsonPath('county.name', 'Komárom-Esztergom');

        $this->assertDatabaseHas('cities', ['name' => 'Esztergom', 'zip' => '3000']);
    }

    /** @test */
    public function it_can_update_a_city()
    {
        $county1 = County::create(['name' => 'Pest']);
        $county2 = County::create(['name' => 'Fejér']);
        $city = City::create(['zip' => '2000', 'name' => 'Szentendre', 'county_id' => $county1->id]);

        $data = [
            'zip' => '2500',
            'name' => 'Dunaújváros',
            'county' => 'Fejér'
        ];

        $response = $this->putJson("/api/cities/{$city->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Dunaújváros', 'zip' => '2500'])
                 ->assertJsonPath('county.name', 'Fejér');

        $this->assertDatabaseHas('cities', ['name' => 'Dunaújváros', 'zip' => '2500']);
    }

    /** @test */
    public function it_can_delete_a_city()
    {
        $county = County::create(['name' => 'Pest']);
        $city = City::create(['zip' => '2000', 'name' => 'Szentendre', 'county_id' => $county->id]);

        $response = $this->deleteJson("/api/cities/{$city->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('cities', ['name' => 'Szentendre']);
    }

    /** @test */
    public function it_fails_validation_for_bad_data()
    {
        $data = [
            'zip' => '12', // too short
            'name' => '',
            'county' => ''
        ];

        $response = $this->postJson('/api/cities', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['zip', 'name', 'county']);
    }
}
