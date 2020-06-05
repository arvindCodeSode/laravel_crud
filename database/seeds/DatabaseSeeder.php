<?php

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
    //here we will not use this prfiletable because profile table has foreign key
        $this->call(ProfileTableSeeder::class);
        $this->call(StudentTableSeeder::class);

    }
}
