<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\JoliDessin;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class JoliDessinTest extends TestCase
{
    public function testBasicAttributes()
    {
        $joliDessin = new JoliDessin();

        $joliDessin->setNom('Mon dessin');
        $joliDessin->setHauteur(10.5);
        $joliDessin->setLargeur(8.3);
        $joliDessin->setVente(true);
        $joliDessin->setPrix(100.0);
        $joliDessin->setDescription('Ceci est un joli dessin.');
        $joliDessin->setSlug('mon-dessin');
        $joliDessin->setFile('image.jpg');
        $joliDessin->setPortfolio(true);
        $creaDate = new \DateTime();
        $melDate = new \DateTime();

        $joliDessin->setCreaDate($creaDate);
        $joliDessin->setMelDate($melDate);

        // Assertions
        $this->assertEquals('Mon dessin', $joliDessin->getNom());
        $this->assertEquals(10.5, $joliDessin->getHauteur());
        $this->assertEquals(8.3, $joliDessin->getLargeur());
        $this->assertTrue($joliDessin->isVente());
        $this->assertEquals(100.0, $joliDessin->getPrix());
        $this->assertEquals('Ceci est un joli dessin.', $joliDessin->getDescription());
        $this->assertEquals('mon-dessin', $joliDessin->getSlug());
        $this->assertEquals('image.jpg', $joliDessin->getFile());
        $this->assertTrue($joliDessin->isPortfolio());
        $this->assertSame($creaDate, $joliDessin->getCreaDate());
        $this->assertSame($melDate, $joliDessin->getMelDate());
    }

    public function testUserRelation()
    {
        $joliDessin = new JoliDessin();
        $user = new User(); // Créer une vraie instance de User

        $joliDessin->setUser($user);
        $this->assertSame($user, $joliDessin->getUser()); // Vérifier que l'utilisateur est bien assigné
    }

    public function testCategorieRelation()
    {
        $joliDessin = new JoliDessin();
        $categorie = new Categorie();

        // Test de l'ajout de la catégorie
        $joliDessin->addCategorie($categorie);
        $this->assertTrue($joliDessin->getCategorie()->contains($categorie));

        // Test de la suppression de la catégorie
        $joliDessin->removeCategorie($categorie);
        $this->assertFalse($joliDessin->getCategorie()->contains($categorie));
    }

    public function testCommentaireRelation()
    {
        $joliDessin = new JoliDessin();
        $commentaire = new Commentaire();

        // Test de l'ajout du commentaire
        $joliDessin->addCommentaire($commentaire);
        $this->assertTrue($joliDessin->getCommentaires()->contains($commentaire));
        $this->assertSame($joliDessin, $commentaire->getJoliDessin());

        // Test de la suppression du commentaire
        $joliDessin->removeCommentaire($commentaire);
        $this->assertFalse($joliDessin->getCommentaires()->contains($commentaire));
        $this->assertNull($commentaire->getJoliDessin());
    }

        //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
}
