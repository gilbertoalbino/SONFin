<?php


use Phinx\Seed\AbstractSeed;

class CategoryCostsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker=\Faker\Factory::create('pt_BR');
        $categoryCosts = $this->table('category_costs');
        $data=[];
        foreach (range(1,10) as $value){
            $data[] = [
                'name' => $faker->company,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $categoryCosts->insert($data)->save();
    }
}

    /* ------------  VERSAO SEM FAKER  ------------ */
    /*
    public function run()
    {
        $categoryCosts = $this->table('category_costs');
        $categoryCosts->insert([
            [
                'name' => 'Cat Custo 1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Cat Custo 2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ])->save();
    }*/


