<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

       $marque1 = new Marque();
       $marque1 -> setLibelle("Toyota");
       $manager -> persist($marque1);

        $marque2 = new Marque();
        $marque2 -> setLibelle("Peugeot");
        $manager -> persist($marque2);

        $modele1 = new Modele();
        $modele1 -> setLibelle("Yaris")
            ->setImage("modele1.jpg")
            ->setPrixMoyen(12300)
            ->setMarque($marque1);
        $manager -> persist($modele1);

        $modele2 = new Modele();
        $modele2 -> setLibelle("Corolla")
            ->setImage("modele2.jpg")
            ->setPrixMoyen(30000)
            ->setMarque($marque1);
        $manager -> persist($modele2);

        $modele3 = new Modele();
        $modele3 -> setLibelle("308")
            ->setImage("modele3.jpg")
            ->setPrixMoyen(22000)
            ->setMarque($marque2);
        $manager -> persist($modele3);

        $modele4 = new Modele();
        $modele4 -> setLibelle("Aygo")
            ->setImage("modele4.jpg")
            ->setPrixMoyen(12500)
            ->setMarque($marque1);
        $manager -> persist($modele4);

        $modele5 = new Modele();
        $modele5 -> setLibelle("3008")
            ->setImage("modele5.jpg")
            ->setPrixMoyen(17000)
            ->setMarque($marque2);
        $manager -> persist($modele5);


        $manager->flush();
    }
}
