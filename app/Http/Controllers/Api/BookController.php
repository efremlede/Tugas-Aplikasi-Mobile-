<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Book::query()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['nullable', 'integer', 'min:0'],
        ]);

        $book = Book::query()->create($data);

        return response()->json($book, 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Book::query()->findOrFail($id));
    }

    public function update(Request $request, string $id): JsonResponse
    {
        // Tambahkan logika update jika diperlukan sesuai dengan kelanjutan project Anda
    }
}