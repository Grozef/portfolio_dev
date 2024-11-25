<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\Commentaire;
use App\Entity\JoliDessin;
use App\Entity\BlogPost;
use PHPUnit\Framework\TestCase;

class CommentaireTest extends TestCase
{
    public function testGettersAndSetters()
    {
            //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
        $commentaire = new Commentaire();
        $date = new \DateTime();

        // Test setAuteur et getAuteur
        $commentaire->setAuteur('Auteur Test');
        $this->assertSame('Auteur Test', $commentaire->getAuteur());

        // Test setEmail et getEmail
        $commentaire->setEmail('auteur@test.com');
        $this->assertSame('auteur@test.com', $commentaire->getEmail());

        // Test setContenu et getContenu
        $commentaire->setContenu('Contenu de test');
        $this->assertSame('Contenu de test', $commentaire->getContenu());

        // Test setDate et getDate
        $commentaire->setDate($date);
        $this->assertSame($date, $commentaire->getDate());

        // Test setJoliDessin et getJoliDessin
        $joliDessin = new JoliDessin();
        $commentaire->setJoliDessin($joliDessin);
        $this->assertSame($joliDessin, $commentaire->getJoliDessin());

        // Test setBlogPost et getBlogPost
        $blogPost = new BlogPost();
        $commentaire->setBlogPost($blogPost);
        $this->assertSame($blogPost, $commentaire->getBlogPost());
    }
}
