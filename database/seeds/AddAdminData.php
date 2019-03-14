<?php


use Illuminate\Database\Seeder;
use App\User;
class AddAdminData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
        ]);
    }
}
