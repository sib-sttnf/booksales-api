<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        if ($books-> isEmpty()){
            return response() ->json([
                "success" => true,
                "message" => 'Resources data not found!'
            ], 200);
        }
        return response()->json([
            "succes" => true, 
            "message" => "Get all resources",
            "data" => $books
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        $books = Book::create(['name' => $request->name]);

        return response()->json($books, 201);
    }

    public function show($id)
    {
        $books = Book::find($id);
        if (!$books) {
            return response()->json(['message' => 'Book tidak ditemukan'], 404);
        }

        return response()->json($books, 200);
    }

    public function update(Request $request, $id)
    {
        $books = Book::find($id);
        if (!$books) {
            return response()->json(['message' => 'Book tidak ditemukan'], 404);
        }

        $request->validate(['name' => 'required|string']);
        $books->update(['name' => $request->name]);

        return response()->json(['message' => 'Book berhasil diperbarui', 'data' => $books], 200);
    }

    public function destroy($id)
    {
        $books = Book::find($id);
        if (!$books) {
            return response()->json(['message' => 'Book tidak ditemukan'], 404);
        }

        $books->delete();
        return response()->json(['message' => 'Book berhasil dihapus'], 200);
    }
}
