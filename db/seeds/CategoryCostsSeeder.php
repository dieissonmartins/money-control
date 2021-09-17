<?php

use Phinx\Seed\AbstractSeed;

final class CategoryCostsSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        $data = [];

        foreach(range(1,1000) as $v) {
            
            $data[$v] = [
                'name' => $faker->name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $categoryCosts = $this->table('category_costs');

        $categoryCosts->insert($data);

        $categoryCosts->save();
    }
}
