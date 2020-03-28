<?php

namespace App\DataFixtures;

use App\Entity\Audio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AudioFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 10; $index++) {
            $audio = new Audio();
            $audio
                ->setOriginalName("Original Audio $index name")
                ->setInsertedAt(new \DateTime("now"))
                ->setFileName("audio_".$index."_name")
                ->setDescription("Audio $index description");

             $manager->persist($audio);
        }

        $manager->flush();
    }
}
