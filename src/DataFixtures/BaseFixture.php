<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    /**
     * @var Generator
     */
    protected $faker;
    /**
     * @var ObjectManager
     */
    private $manager;

    abstract protected function loadData(ObjectManager $em);

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
        $this->loadData($manager);
    }

    protected function createMany(int $count, string $classname, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $classname();
            $factory($entity, $i);

            $this->manager->persist($entity);
            $this->addReference($classname. '_'. $i, $entity);
        }
    }
}