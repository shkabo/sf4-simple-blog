<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Helper\PasswordTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    use PasswordTrait;

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, User::class, function(User $user, $count) {
           $user->setEmail(sprintf('testmail%d@example.com', $count));
           $user->setPassword($this->hash($user, '1234567890'));
           $user->setFullName($this->faker->firstName . ' ' . $this->faker->lastName);

           return $user;
        });
        $manager->flush();
    }
}
