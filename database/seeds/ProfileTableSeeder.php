<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //here we will not use this prfiletable because profile table has foreign key
        factory(App\Profile::class,5)->create();
    }
}
