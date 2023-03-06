<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Portal\Users;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $user = new Users();

        $arrData = [
            'first_name'            => 'Juan',
            'last_name'             => 'Dela Cruz',
            'position'              => 'Developer',
            'user_name'             => 'Admin',
            'user_email'            => 'ajhay.dev@gmail.com',
            'user_password'         => 'YBO60giQPoFef05oW+gMmg==',
            'user_status'           => 1,
            'created_date'          => date('Y-m-d H:i:s'),
            'updated_date'          => null
        ];

        $user->insert($arrData);
    }
}
