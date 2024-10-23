<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_books() : void
    {
        Book::factory()->count(3)->create();

        $response = $this->get('/books');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json()['data']);
    }

    public function test_get_book() : void
    {
        $book = Book::factory()->create();

        $response = $this->get("/books/" . $book->id); 

        $response->assertStatus(200);
        $this->assertEquals($book->name, $response->json()['name']);
    }

    public function test_rent_book() : void
    {
        $book = Book::factory()->create();
        $client = Client::factory()->create();

        $response = $this->put('/books/rent', [
            'book_id' => $book->id,
            'client_id' => $client->id,
        ]); 

        $response->assertStatus(200);
        $this->assertEquals('Książka została wypożyczona', $response->json()['message']);
        $this->assertEquals($client->id, $book->fresh()->rent_user_id);
    }
}