<?php

use App\User;
use App\Answer;
use App\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // factory(User::class, 3)->create();
        // factory(Question::class, 20)->create();
        factory(User::class, 3)->create()
        ->each(function ($u){
            $u->questions()
              ->saveMany(
                factory(Question::class, rand(1,5))->make())
                ->each(function($q){
                    $q->answers()
                      ->saveMany(
                          factory(Answer::class, rand(1,5))->make()
                      );
                });
        });
    }
}
