<?php

use App\User;
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
        factory(App\User::class, 5)->create();
        $this->createAdminUser();
    }
    public function createAdminUser(){
        $user = factory(User::class)->create([
            'name' => 'manager',
            'mobile' => '09904203460',
            'type' => User::TYPE_ADMIN,
        ]);
    }
}
