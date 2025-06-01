<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json([
            "succes" => true,
            "message" => "Get all resources",
            "data" => $authors
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $authors = Author::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Author berhasil ditambahkan',
            'data' => $authors,
        ], 201);
    }
    public function show($id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json(['message' => 'Author tidak ditemukan'], 404);
        }

        return response()->json($authors, 200);
    }

    public function update(Request $request, $id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json(['message' => 'Author tidak ditemukan'], 404);
        }

        $request->validate(['name' => 'required|string']);
        $authors->update(['name' => $request->name]);

        return response()->json(['message' => 'Author berhasil diperbarui', 'data' => $authors], 200);
    }

    public function destroy($id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json(['message' => 'Author tidak ditemukan'], 404);
        }

        $authors->delete();
        return response()->json(['message' => 'Author berhasil dihapus'], 200);
    }
}
