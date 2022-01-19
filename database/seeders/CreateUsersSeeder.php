<?php
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
                'is_admin'=>'1',
               'password'=> bcrypt('admin1234'),
            ],
            [
               'name'=>'Dama',
               'email'=>'dama@gmail.com',
                'is_admin'=>'0',
               'password'=> bcrypt('dama1234'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}