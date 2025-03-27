<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use App\Factory\VoitureFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VoitureFactory::createMany(20);
    }
}
