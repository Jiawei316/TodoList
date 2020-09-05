<?php

use Illuminate\Database\Seeder;
use App\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Todo::create([
           'title' => 'Test',
           'content' => 'Restful Api'
        ]);

        Todo::create([
            'title' => 'Test1',
            'content' => '1'
        ]);

        Todo::create([
            'title' => 'Test2',
            'content' => '2'
        ]);

        Todo::create([
            'title' => 'Test3',
            'content' => '3'
        ]);
    }
}
