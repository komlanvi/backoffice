<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        $users = ["gabin" => "gabin-password", "hermann" => "hermann-password", "komlanvi" => "dev-backoffice-password"];

        foreach ($users as $username => $password) {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $password
            ));

            $manager->persist($user);
        }

        $apiUser = new User();
        $apiUser
            ->setUsername("ApiUser")
            ->setPassword("ApiUser")
            ->setApiToken("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9");

        $manager->persist($apiUser);

        $manager->flush();
    }
}
