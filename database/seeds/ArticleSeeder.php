<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantUsers = \App\User::get()->count();
        for ($i = 1; $i <= random_int(10, 25); $i++) {
            factory(\App\Article::class, 1)->create(['user_id' => random_int(1,$cantUsers)]);
        }

        \App\Article::create(array(
            'user_id' => 3,
            'title' => 'Machine Learning',
            'description' => 'Una breve introducción a lo que es el machine learning, y algunos apuntes',
            'content' => 'Contenido del post.'
        ));

        \App\Article::create(array(
            'user_id' => 2,
            'title' => 'Como tener 100% win rate en Fortnite',
            'description' => 'La mejor guia especializada (?',
            'content' => 'No la manquees.'
        ));

    }
}
