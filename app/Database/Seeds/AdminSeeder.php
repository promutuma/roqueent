<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $users = model(UserModel::class);

        $admin = new User([
            'username' => 'admin',
            'email' => 'framutuma@gmail.com',
            'password' => 'admin123',
        ]);

        if ($users->save($admin)) {
            // Get the inserted user to add group and custom profile data
            $admin = $users->findById($users->getInsertID());

            // Add to superadmin group
            $admin->addGroup('superadmin');

            // Set custom profile fields
            $users->update($admin->id, [
                'user_id' => 'ADMIN001',
                'user_email' => 'admin@example.com',
                'user_fname' => 'System',
                'user_oname' => 'Administrator',
                'user_type' => 'superadmin',
                'user_status' => '1',
                'active' => 1,
            ]);

            echo "Initial administrator created successfully!\n";
            echo "Email: admin@example.com\n";
            echo "Password: admin123\n";
        } else {
            echo "Failed to create initial administrator.\n";
            print_r($users->errors());
        }
    }
}
