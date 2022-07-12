<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $demoUser = User::create([
            'first_name'        => 'Super',
            'last_name'         => 'Admin',
            'email'             => 'admin@rayasabari.com',
            'password'          => Hash::make('rysbadmin'),
            'email_verified_at' => now(),
            'api_token'         => Hash::make('admin@admin'),
        ]);

        $this->addDummyInfo($faker, $demoUser);

        // User::factory(100)->create()->each(function (User $user) use ($faker) {
        //     $this->addDummyInfo($faker, $user);
        // });
    }

    private function addDummyInfo(Generator $faker, User $user)
    {
        $dummyInfo = [
            'company'  => 'RYSB',
            'phone'    => $faker->phoneNumber,
            'website'  => 'www.rayasabari.com',
            'language' => 'id',
            'country'  => 'ID',
        ];

        $info = new UserInfo();
        foreach ($dummyInfo as $key => $value) {
            $info->$key = $value;
        }
        $info->user()->associate($user);
        $info->save();
    }
}
