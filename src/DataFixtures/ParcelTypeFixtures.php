<?php

namespace App\DataFixtures;

use App\Entity\ParcelType;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParcelTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $types = [
            [
                'name' => 'Eko',
                'price' => 8,
                'realizationDays' => 4,
                'insuranceAmount' => 500,
                'maxWeight' => 3
            ],
            [
                'name' => 'Premium',
                'price' => 13,
                'realizationDays' => 2,
                'insuranceAmount' => 5000,
                'maxWeight' => 8
            ],
            [
                'name' => 'Super',
                'price' => 20,
                'realizationDays' => 2,
                'insuranceAmount' => 1000,
                'maxWeight' => 25
            ]
        ];

        foreach ($types as $typeData) {
            $type = new ParcelType();
            foreach ($typeData as $property => $value) {
                $method = 'set' . ucfirst($property);
                $type->$method($value);
            }
            $manager->persist($type);
        }

        $manager->flush();
    }
}
