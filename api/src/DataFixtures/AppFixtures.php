<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use App\Entity\Document;
use App\Entity\Level;
use App\Entity\pathway;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $degreesList = [];
        $optionsList = [];
        $levelsList = [];

        // Degrees Fixtures
        for ($i = 0; $i < 5; $i++) {
            $degree = new Degree();
            $degree->setLabel('degree ' . $i);
            $manager->persist($degree);

            $degreesList[] = $degree;
        }

        // Options Fixtures
        for ($i = 0; $i < 10; $i++) {
            $option = new pathway();
            $option->setLabel('opt ' . $i);
            $option->setDegree($degreesList[0]);
            $manager->persist($option);

            $optionsList[] = $option;
        }

        // Levels Fixtures
        for ($i = 0; $i < 3; $i++) {
            $level = new Level();
            $level->setLabel('level ' . $i);
            $manager->persist($level);

            $levelsList[] = $level;
        }

        // Documents Fixtures
        for ($i = 0; $i < 10; $i++) {
            $document = new Document();
            $document->setAuthor('author ' . $i);
            $document->setTitle('examen ' . $i);
            $document->setCreatedAt(new DateTimeImmutable());
            $document->addDegree($degreesList[array_rand($degreesList)]);
            $document->addLevel($levelsList[array_rand($levelsList)]);
            $document->addPathway($optionsList[array_rand($optionsList)]);

            $manager->persist($document);
        }

        $manager->flush();
    }
}
