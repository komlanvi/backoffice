<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VideoFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 10; $index++) {
            $video = new Video();
            $video
                ->setOriginalName("Video $index original name")
                ->setFileName("video_".$index."_name")
                ->setInsertedAt(new \DateTime("now"))
                ->setDescription("Video $index description");

            $manager->persist($video);
        }

        $manager->flush();
    }
}
