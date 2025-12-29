<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;

class InitialUserSeeders extends Seeder
{
    public function run()
    {
        $users = model('UserModel');

        $user = new User([
            'username' => 'admin',
            'email'    => 'youhunt@gmail.com',
            'password' => 'admin123',
            'active'   => 1,
        ]);

        $users->save($user);
        $userId = $users->getInsertID();

        // assign group
        $users->addToGroup($userId, 'administrator');

        // profile
        $this->db->table('user_profiles')->insert([
            'user_id' => $userId,
            'fullname' => 'Administrator Sistem',
            'trust_level' => 'trusted'
        ]);
    }
}
