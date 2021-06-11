<?php

namespace App\DataFixtures;

use App\Entity\Warehouse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WarehouseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $warehouses = [
            [
                'name' => 'Magazyn 1 (Lublin)',
            ],
            [
                'name' => 'Magazyn 2 (Warszawa)',
            ]
        ];

        foreach ($warehouses as $warehouseData) {
            $warehouse = new Warehouse();
            $warehouse->setName($warehouseData['name']);

            $manager->persist($warehouse);
        }

        $manager->flush();
    }
}
