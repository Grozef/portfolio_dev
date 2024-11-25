<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\Categorie;
use App\Entity\JoliDessin;
use PHPUnit\Framework\TestCase;

class CategorieTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $categorie = new Categorie();

        // Test setNom et getNom
        $categorie->setNom('Nature');
        $this->assertSame('Nature', $categorie->getNom());

        // Test setDescription et getDescription
        $categorie->setDescription('Description de la catégorie Nature');
        $this->assertSame('Description de la catégorie Nature', $categorie->getDescription());

        // Test setSlug et getSlug
        $categorie->setSlug('nature');
        $this->assertSame('nature', $categorie->getSlug());
    }

    public function testAddAndRemoveJoliDessin()
    {
        $categorie = new Categorie();
        $joliDessin = new JoliDessin();

        // Test addJoliDessin
        $categorie->addJoliDessin($joliDessin);
        $this->assertCount(1, $categorie->getJoliDessins());
        $this->assertTrue($categorie->getJoliDessins()->contains($joliDessin));

        // Test removeJoliDessin
        $categorie->removeJoliDessin($joliDessin);
        $this->assertCount(0, $categorie->getJoliDessins());
        $this->assertFalse($categorie->getJoliDessins()->contains($joliDessin));
    }

        //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
}
