<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const MAIN_USER = 'main_user';

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('PHP')
            ->setEmail('phpteam@makolab.com')
            ->setFirstname('PHP')
            ->setLastname('Team')
            ->setBirthday(new DateTime('2020-01-10'))
            ->setCountry('Poland');
        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::MAIN_USER, $user);
    }
}
