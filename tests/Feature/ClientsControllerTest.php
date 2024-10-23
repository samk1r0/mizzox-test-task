<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_clients() : void
    {
        Client::factory()->count(3)->create();

        $response = $this->get('/clients');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json());
    }

    public function test_get_client() : void
    {
        $client = Client::factory()->create();

        $response = $this->get("/clients/" . $client->id);

        $response->assertStatus(200);
        $this->assertEquals($client->name, $response->json()['name']);
    }

    public function test_create_client() : void
    {
        $response = $this->post('/clients', [
            'name' => 'Test Name',
            'surname' => 'Test Surname',
        ]);

        $response->assertStatus(201);
        $this->assertEquals('Test Name', $response->json()['name']);
        $this->assertEquals('Test Surname', $response->json()['surname']);
    }

    public function test_delete_client() : void
    {
        $client = Client::factory()->create();

        $response = $this->delete("/clients/" . $client->id);

        $response->assertStatus(200);
        $this->assertEquals(['message' => 'Client deleted successfully'], $response->json());
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }
}