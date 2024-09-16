<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Produits;
use App\Entity\Interventions;
use App\Entity\InterventionProduit;

class AppFixtures extends Fixture
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $velos_references = [
            "Peugeot" => ["Citystar", "RC500", "RCZ", "E-Legend"],
            "Lapierre" => ["Overvolt", "Aircode", "Xelius"],
            "Look" => ["999 Race", "795 Blade", "695", "E-765"],
            "Btwin" => ["Rockrider 540", "Ultra AF", "Riverside", "Elops"],
            "Cyfac" => ["XCR", "RSL", "Voyageur", "E-Gravel"],
            "Meral" => ["Trail 900", "Speedster", "Urban", "E-City"],
            "Dilecta" => ["Raptor", "Chrono", "Trekking", "E-Trekking"],
            "Van Rysel" => ["MTB 920", "Road Race", "Allroad", "E-Cargo"],
            "Triban" => ["Riverside 500", "RC 520", "City", "E-Cité"],
            "Gir's" => ["Enduro Pro", "Sprint", "Cruiser", "E-MTB"],
            "Victoire" => ["Summit", "Aero", "Classique", "E-Road"],
            "Origine" => ["Trail", "Endurance", "Comfort", "E-Folding"],
            "Heroïn" => ["Dirt Jump", "Fixie", "BMX", "E-BMX"],
            "Stajvelo" => ["Gravel", "Cyclocross", "Tout-terrain", "E-Adventure"]
        ];
        /* Génération des produits */
        for ($i = 0 ; $i < 20 ; $i++) {
            $produit = new Produits();
            $produit->setDesignation("Designation" . $i);
            $produit->setPrix(random_int(1, 100) - 0.01);
            $description = $this->client->request(
                'GET',
                'https://loripsum.net/api/2/plaintext'
            );
            $produit->setDescription($description->getContent());
            $manager->persist($produit);
        }
        for ($i = 0 ; $i < 30 ; $i++) {
            $intervention = new Interventions();
            $intervention->setVeloElectrique($i%2);
            $intervention->setVeloCategorie("Catégorie");
            $marque = array_rand($velos_references);
            $modeles = $velos_references[$marque];
            $modeleAleatoire = $modeles[array_rand($modeles)];
            $intervention->setVeloMarque($marque);
            $intervention->setVeloModele($modeleAleatoire);
            $intervention->setAdresse("Adresse " . $i);
            $manager->persist($intervention);
        }

        $manager->flush();
    }
}
