<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Parasita',
                'director' => 'Bong Joon-ho',
                'year' => 2019,
                'genre' => 'Thriller',
                'synopsis' => 'Uma família pobre se infiltra na vida de uma família rica com consequências inesperadas.',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg',
                'duration' => 132
            ],
            [
                'title' => 'Cidade de Deus',
                'director' => 'Fernando Meirelles',
                'year' => 2002,
                'genre' => 'Drama',
                'synopsis' => 'A história da criminalidade na favela Cidade de Deus, no Rio de Janeiro.',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/gCqnQaq8T4CjMZ2EQB7LTGJu3kX.jpg',
                'duration' => 130
            ],
            [
                'title' => 'Pulp Fiction',
                'director' => 'Quentin Tarantino',
                'year' => 1994,
                'genre' => 'Crime',
                'synopsis' => 'Histórias entrelaçadas de criminosos em Los Angeles.',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/plnlrtBUULT0rh3Xsjmpubiso3L.jpg',
                'duration' => 154
            ],
            [
                'title' => 'Bacurau',
                'director' => 'Kleber Mendonça Filho',
                'year' => 2019,
                'genre' => 'Thriller',
                'synopsis' => 'Uma pequena cidade do sertão brasileiro enfrenta uma ameaça misteriosa.',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/1yKGBbQcbHtib7ksurYYpUOydAE.jpg',
                'duration' => 131
            ],
            [
                'title' => 'Moonlight',
                'director' => 'Barry Jenkins',
                'year' => 2016,
                'genre' => 'Drama',
                'synopsis' => 'A jornada de autodescoberta de um jovem negro em três momentos de sua vida.',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/4911T5FbJ9eD2Faz5Z8cT3SUhU3.jpg',
                'duration' => 111
            ]
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}