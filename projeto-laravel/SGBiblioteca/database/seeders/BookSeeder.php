<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {

        Book::create([
            'title' => 'Dom Casmurro',
            'author_id' => 1,
            'publisher_id' => 1,
            'published_year' => 1899
        ]);

        Book::create([
            'title' => 'A Hora da Estrela',
            'author_id' => 2,
            'publisher_id' => 2,
            'published_year' => 1977
        ]);

        Book::create([
            'title' => 'Capitães da Areia',
            'author_id' => 3,
            'publisher_id' => 2,
            'published_year' => 1937
        ]);

        Book::create([
            'title' => 'O Alquimista',
            'author_id' => 4,
            'publisher_id' => 3,
            'published_year' => 1988
        ]);


        Book::create([
            'title' => 'Harry Potter e a Pedra Filosofal',
            'author_id' => 5,
            'publisher_id' => 4,
            'published_year' => 1997
        ]);

        Book::create([
            'title' => '1984',
            'author_id' => 6,
            'publisher_id' => 3,
            'published_year' => 1949
        ]);

        Book::create([
            'title' => 'O Senhor dos Anéis: A Sociedade do Anel',
            'author_id' => 7,
            'publisher_id' => 5,
            'published_year' => 1954
        ]);
    }
}
