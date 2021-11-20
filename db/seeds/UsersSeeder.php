<?php

use Phinx\Seed\AbstractSeed;

final class UsersSeeder extends AbstractSeed
{
    public function run()
    {

        $app = require  __DIR__ . '/../bootstrap.php';
        $auth = $app->service('auth');

        $faker = Faker\Factory::create('pt_BR');

        $data = [];

        foreach(range(1,100) as $v) {
            
            $data[$v] = [
                'id' => $v,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => $auth->hashPassword('123456'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $users = $this->table('users');

        $users->insert($data);

        $users->save();
    }
}
