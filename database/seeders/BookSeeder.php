<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'description' => 'An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.',
            'price' => 50000,
            'stock' => 50,
            'cover_photo' => 'harry_potter.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ]);

        Book::create([
            'title' => 'The Shining',
            'description' => 'A family heads to an isolated hotel for the winter where an evil and sinister presence influences the father into violence, while his psychic son sees horrific premonitions from both past and future.',
            'price' => 25000,
            'stock' => 30,
            'cover_photo' => 'the_shining.jpg',
            'genre_id' => 2,
            'author_id' => 2,
        ]);

        Book::create([
            'title' => 'Laskar Pelangi',
            'description' => 'An inspiring story about the struggle of a group of students and their two teachers in a remote village in Belitung to keep their school alive.',
            'price' => 40000,
            'stock' => 75,
            'cover_photo' => 'laskar_pelangi.jpg',
            'genre_id' => 3,
            'author_id' => 3,
        ]);
    }
}
