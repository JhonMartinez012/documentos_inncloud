<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sql = User::create([
            'name' => 'Innclod',
            'email' => 'innclod@mail.com',
            'password'=>'$2y$10$qa8rKFPTbnhDqX97Qb.Ze.sxZa2nCoFcv38JKVBNJOUojhXLxAS6K'
        ]);
    }
}
