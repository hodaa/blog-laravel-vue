<?php


use Illuminate\Database\Seeder;
use App\User;
class AddAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
        ]);
    }
}
