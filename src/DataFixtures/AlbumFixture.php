<?php

namespace App\DataFixtures;

use App\Entity\Album;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class AlbumFixture
 * @package App\DataFixtures
 */
class AlbumFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 10; $i++) {
            $album = new Album();
            $album->setName(rtrim($faker->realText(20), '.'));
            $album->setDescription($faker->realText('500'));
            $album->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0.99, $max = 65));
            $album->setCategory($this->getReference("CAT_" . mt_rand(1, 3)));
            $album->setCreateAt(new DateTime());
            $manager->persist($album);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [CategoryFixture::class];
    }
}
