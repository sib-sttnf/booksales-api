<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'J.K. Rowling',
            'photo' => 'jkrowling.png',
            'bio' => 'Penulis Inggris di balik seri fantasi Harry Potter yang mendunia, menceritakan petualangan seorang penyihir muda dan teman-temannya di sekolah sihir Hogwarts.',
        ]);

        Author::create([
            'name' => 'Stephen King',
            'photo' => 'stephen.png',
            'bio' => 'Penulis Amerika yang dikenal karena karya-karya horor, supernatural, suspense, dan fantasi, sering kali mengeksplorasi sisi gelap psikologi manusia.',
        ]);

        Author::create([
            'name' => 'Andrea Hirata',
            'photo' => 'andrea.png',
            'bio' => 'Penulis Indonesia yang terkenal dengan novel Laskar Pelangi, sebuah kisah inspiratif tentang perjuangan anak-anak di sebuah sekolah miskin di Belitung untuk meraih mimpi.',
        ]);
    }
}
