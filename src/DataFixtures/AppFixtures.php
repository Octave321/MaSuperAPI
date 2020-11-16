<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstname);
            $user->setLastName($faker->lastname);
            $user->setrole($faker->randomElement($array = array ('ROLE_ADMIN','ROLE_USER')));
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'firstname' => $this->getFirstName(),
            'lastname' => $this->getLastName(),
            'collection_objects' => $this->collection_objects->map(
                function(\MyMini\CollectionBundle\Entity\CollectionObject $o) {
                    return $o->toArray();
                }
            )->toArray()
        ];
    }


}
