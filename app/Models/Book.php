<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Author;
use App\Models\Genre;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    // Kolom-kolom yang bisa diisi massal (mass-assignment)
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'cover_photo',
        'author_id',
        'genre_id',
    ];

    // Relasi ke author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relasi ke genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
