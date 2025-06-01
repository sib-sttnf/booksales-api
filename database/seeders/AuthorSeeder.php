<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::insert([
            ['name' => 'Leila S. Chudori'],
            ['name' => 'Chairil Anwar'],
            ['name' => 'J.K. Rowling'],
            ['name' => 'Mark Twain'],
            ['name' => 'Haruki Murakami'],
        ]);
    }
}
