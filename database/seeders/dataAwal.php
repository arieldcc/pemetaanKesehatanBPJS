<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dataAwal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Administrotor';
        $user->email = 'admin@gmail.com';
        $user->role = 'Admin';
        $user->password = bcrypt('admin1234');
        $user->save();
    }
}
