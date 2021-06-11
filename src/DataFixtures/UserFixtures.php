<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@local.local');
        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'secret'
        ));

        $manager->persist($user);

        $user = new User();
        $user->setEmail('courier@local.local');
        $user->setFirstName('Kurier1');
        $user->setLastName('Kurier1');
        $user->setType(User::TYPE_COURIER);
        $user->setRoles(['ROLE_COURIER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'secret'
        ));

        $manager->persist($user);

        $manager->flush();
    }
}
