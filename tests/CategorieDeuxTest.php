<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\Categorie;
use App\Entity\JoliDessin;
use PHPUnit\Framework\TestCase;

class CategorieDeuxTest extends TestCase
{

        //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
        
    public function testGetNom()
    {
        $categorie = new Categorie();
        $categorie->setNom('Nature');
        $this->assertSame('Nature', $categorie->getNom());
    }

    public function testSetNom()
    {
        $categorie = new Categorie();
        $categorie->setNom('Nature');
        $this->assertSame('Nature', $categorie->getNom());
    }

    public function testGetDescription()
    {
        $categorie = new Categorie();
        $categorie->setDescription('Description de la catégorie Nature');
        $this->assertSame('Description de la catégorie Nature', $categorie->getDescription());
    }

    public function testSetDescription()
    {
        $categorie = new Categorie();
        $categorie->setDescription('Description de la catégorie Nature');
        $this->assertSame('Description de la catégorie Nature', $categorie->getDescription());
    }

    public function testGetSlug()
    {
        $categorie = new Categorie();
        $categorie->setSlug('nature');
        $this->assertSame('nature', $categorie->getSlug());
    }

    public function testSetSlug()
    {
        $categorie = new Categorie();
        $categorie->setSlug('nature');
        $this->assertSame('nature', $categorie->getSlug());
    }

    public function testAddJoliDessin()
    {
        $categorie = new Categorie();
        $joliDessin = new JoliDessin();
        $categorie->addJoliDessin($joliDessin);
        $this->assertCount(1, $categorie->getJoliDessins());
        $this->assertTrue($categorie->getJoliDessins()->contains($joliDessin));
    }

    public function testRemoveJoliDessin()
    {
        $categorie = new Categorie();
        $joliDessin = new JoliDessin();
        $categorie->addJoliDessin($joliDessin);
        $categorie->removeJoliDessin($joliDessin);
        $this->assertCount(0, $categorie->getJoliDessins());
        $this->assertFalse($categorie->getJoliDessins()->contains($joliDessin));
    }
}
