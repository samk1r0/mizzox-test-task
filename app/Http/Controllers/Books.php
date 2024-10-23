<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class Books
{
    public function list(Request $request): LengthAwarePaginator
    {
        $books = Book::query();

        $books->with('client')
              ->select(['name', 'author', 'rent_user_id']);

        $filters = [
            'title' => 'name',
            'author' => 'author',
            'name' => 'clients.name',
            'surname' => 'clients.surname',
        ];

        foreach ($filters as $requestKey => $column) {
            if ($request->has($requestKey)) {
                $books->whereHas('client', function ($query) use ($column, $requestKey, $request) {
                    $query->where($column, 'like', '%' . $request->$requestKey . '%');
                });
            }
        }
        
        return $books->paginate(20);
    }

    public function get(string $id) : Book
    {
        $book = Book::with(['client'])
        ->where('id', $id)
        ->firstOrFail(['name', 'author', 'year_of_release', 'publisher', 'rent_user_id']);
        return $book;
    }

    public function rent(Request $request) : JsonResponse
    {
        $bookId = $request->input('book_id');
        $clientId = $request->input('client_id');
        $book = Book::find($bookId);
        $message = 'Książka nie została znaleziona';
        if (!$book) {
            return response()->json(['message' => $message], 404);
        }
        if ($clientId) {
            $message = $book->rent_user_id ? 'Książka zmieniła wypożyczyciela' : 'Książka została wypożyczona';
            $book->rent_user_id = $clientId;
        } else {
            $message = $book->rent_user_id ? 'Książka została zwrócona' : 'Książka nie zmieniła swego właściciela i jest dostępna do wynajęcia';
            $book->rent_user_id = null;
        }
        $book->save();
        return response()->json(['message' => $message], 200);
    }
}
