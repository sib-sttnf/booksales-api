<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        $genres = Genre::create(['name' => $request->name]);

        return response()->json($genres, 201);
    }

    public function show($id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json(['message' => 'Genre tidak ditemukan'], 404);
        }

        return response()->json($genres, 200);
    }

    public function update(Request $request, $id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json(['message' => 'Genre tidak ditemukan'], 404);
        }

        $request->validate(['name' => 'required|string']);
        $genres->update(['name' => $request->name]);

        return response()->json(['message' => 'Genre berhasil diperbarui', 'data' => $genres], 200);
    }

    public function destroy($id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json(['message' => 'Genre tidak ditemukan'], 404);
        }

        $genres->delete();
        return response()->json(['message' => 'Genre berhasil dihapus'], 200);
    }
}
