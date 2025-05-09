<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brammah = User::create([
            'first_name'  => 'Brian',
            'last_name'   => 'Ochieng',
            'username'    => 'brammah',
            'status'      => 1,
            'branch_id'   => 1,
            'gender'      => 'M',
            'phone'       => '254711249293',
            'email'       => 'bbrianochieng@outlook.com',
            'is_admin'    => 1,
            'is_pseudo'   => 1,
            'is_web_user' => 1,
            'is_app_user' => 1,
            'password'    => bcrypt(App::environment('production') ? 'Bbrammah12#$' : 'password'),
        ]);

        $brammah->assignRole('Super Admin');
    }
}
