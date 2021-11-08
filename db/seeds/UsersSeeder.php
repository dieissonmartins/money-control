<?php

use Phinx\Seed\AbstractSeed;

final class UsersSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        $data = [];

        foreach(range(1000,10000) as $v) {
            
            $data[$v] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => $faker->password,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $users = $this->table('users');

        $users->insert($data);

        $users->save();
    }
}
