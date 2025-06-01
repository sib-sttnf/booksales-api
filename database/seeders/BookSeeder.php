<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Laut Bercerita',
            'author_id' => 1,
            'genre_id' => 1,
            'price' => 75000.00,
            'stock' => 10,
            'cover_photo' => 'laut.jpg',
        ]);

        Book::create([
            'title' => 'Puisi',
            'author_id' => 2,
            'genre_id' => 2,
            'price' => 50000.00,
            'stock' => 15,
            'cover_photo' => 'puisi.jpg',

        ]);
        Book::create([
            'title' => 'Harry Potter',
            'author_id' => 3,
            'genre_id' => 3,
            'price' => 90000.00,
            'stock' => 20,
            'cover_photo' => 'hp.jpg',

        ]);
        Book::create([
            'title' => 'Adventures of Tom Sawyer',
            'author_id' => 4,
            'genre_id' => 4,
            'price' => 65000.00,
            'stock' => 12,
            'cover_photo' => 'tom.jpg',

        ]);
        Book::create([
            'title' => 'Kafka on the Shore',
            'author_id' => 5,
            'genre_id' => 5,
            'price' => 80000.00,
            'stock' => 8,
            'cover_photo' => 'kafka.jpg',

        ]);
    }
}
