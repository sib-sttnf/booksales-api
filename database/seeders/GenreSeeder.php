<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            [
                'name' => 'Romance',
                'description' => 'Stories about love and relationships'
            ],
            [
                'name' => 'Comedy',
                'description' => 'Will make u laugh till your stomach hurt'
            ],
            [
                'name' => 'Mystery',
                'description' => 'Suspenseful stories with puzzles to solve'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'delulu as its finest an adventure'
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Magical and supernatural stories'
            ]
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
