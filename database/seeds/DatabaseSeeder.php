<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        $this->call(AddAdmin::class);
        $this->call(AddCategories::class);
    }
}
