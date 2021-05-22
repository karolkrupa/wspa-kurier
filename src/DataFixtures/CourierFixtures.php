<?php

namespace App\DataFixtures;

use App\Entity\Courier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourierFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $couriers = [
            [
                'name' => 'DPD',
                'www' => 'http://dpd.pl'
            ],
            [
                'name' => 'DHL',
                'www' => 'http://dhl.pl'
            ],
            [
                'name' => 'Poczta Polska',
                'www' => 'http://pocztapolska.pl'
            ],
            [
                'name' => 'InPost',
                'www' => 'http://inpost.pl'
            ]
        ];

        foreach ($couriers as $courierData) {
            $courier = new Courier();
            foreach ($courierData as $property => $value) {
                $method = 'set' . ucfirst($property);
                $courier->$method($value);
            }
            $manager->persist($courier);
        }

        $manager->flush();
    }
}
