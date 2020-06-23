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
        \App\Article::create(array(
            'user_id' => 3,
            'title' => 'Machine Learning',
            'description' => 'Una breve introducción a lo que es el machine learning, y algunos apuntes',
            'content' => 'Contenido del post.'
        ));

        \App\Article::create(array(
            'user_id' => 1,
            'title' => 'Como tener 100% win rate en Fortnite',
            'description' => 'La mejor guia especializada (?',
            'content' => 'No la manquees.'
        ));
    }
}
