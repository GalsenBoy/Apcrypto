<?php

namespace App\DataFixtures;

use App\Entity\AnalyseTechnique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Analyse extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

       
        for ($i = 0; $i < 8; $i++) {
            $analyse = new AnalyseTechnique;
            $analyse->setActif('Bitcoin');
            $analyse->setAnalyse('https://fr.tradingview.com/chart/');
            $analyse->setExplication('Lorem ipsum oizboib aioehaibe aheoabze aeihaiobczoii aieaobnzibizfa moac oaihzf akhzifakbkhoj');
            $analyse->setDate(new \DateTime());
            $manager->persist($analyse);
        }
        $manager->flush();
    }
}
