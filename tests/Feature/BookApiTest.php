<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_can_be_listed(): void
    {
        Book::create([
            'title' => 'Laravel REST API',
            'description' => 'Panduan Laravel',
            'status' => 1,
        ]);

        $this->getJson('/api/books')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.title', 'Laravel REST API');
    }

    public function test_a_book_can_be_created(): void
    {
        $this->postJson('/api/books', [
            'title' => 'Laravel REST API',
            'description' => 'Panduan Laravel',
            'status' => 1,
        ])
            ->assertCreated()
            ->assertJsonPath('title', 'Laravel REST API');

        $this->assertDatabaseHas('books', [
            'title' => 'Laravel REST API',
            'description' => 'Panduan Laravel',
            'status' => 1,
        ]);
    }

    public function test_book_creation_requires_valid_fields(): void
    {
        $this->postJson('/api/books', [
            'title' => '',
            'description' => '',
            'status' => -1,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'description', 'status']);
    }

    public function test_a_book_can_be_shown_and_updated(): void
    {
        $book = Book::create([
            'title' => 'Laravel REST API',
            'description' => 'Panduan Laravel',
            'status' => 1,
        ]);

        $this->getJson("/api/books/{$book->id}")
            ->assertOk()
            ->assertJsonPath('id', $book->id);

        $this->patchJson("/api/books/{$book->id}", [
            'status' => 2,
        ])
            ->assertOk()
            ->assertJsonPath('status', 2);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Laravel REST API',
            'status' => 2,
        ]);
    }

    public function test_put_updates_require_all_book_fields(): void
    {
        $book = Book::create([
            'title' => 'Laravel REST API',
            'description' => 'Panduan Laravel',
            'status' => 1,
        ]);

        $this->putJson("/api/books/{$book->id}", [
            'title' => 'Judul baru',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['description', 'status']);
    }

    public function test_a_book_can_be_deleted(): void
    {
        $book = Book::create([
            'title' => 'Laravel REST API',
            'description' => 'Panduan Laravel',
            'status' => 1,
        ]);

        $this->deleteJson("/api/books/{$book->id}")
            ->assertOk()
            ->assertJsonPath('message', 'Book deleted');

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_unknown_books_return_not_found(): void
    {
        $this->getJson('/api/books/999999')->assertNotFound();
    }
}
