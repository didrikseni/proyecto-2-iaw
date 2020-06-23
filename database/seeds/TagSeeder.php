<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tag::create(array('name' => 'Cursadas'));
        \App\Tag::create(array('name' => 'Resumenes'));
        \App\Tag::create(array('name' => 'Educación'));
        \App\Tag::create(array('name' => 'Programación'));
        \App\Tag::create(array('name' => 'Lenguajes de Programación'));
        \App\Tag::create(array('name' => 'Software'));
        \App\Tag::create(array('name' => 'Ciencias de la computación'));
        \App\Tag::create(array('name' => 'Investigación'));
        \App\Tag::create(array('name' => 'Hardware'));
        \App\Tag::create(array('name' => 'Diseño'));
        \App\Tag::create(array('name' => 'Hola mundo'));
        \App\Tag::create(array('name' => 'Off-topic'));
        \App\Tag::create(array('name' => 'Framework'));
        \App\Tag::create(array('name' => 'Web'));
        \App\Tag::create(array('name' => 'Aplicación'));
        \App\Tag::create(array('name' => 'Desarrollo'));
        \App\Tag::create(array('name' => 'Proyecto'));
    }
}
