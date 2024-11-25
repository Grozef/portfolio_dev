<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\Commentaire;
use App\Entity\JoliDessin;
use App\Entity\BlogPost;
use PHPUnit\Framework\TestCase;

class CommentaireDeuxTest extends TestCase
{
        //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
    public function testGetAuteur()
    {
        $commentaire = new Commentaire();
        $commentaire->setAuteur('Auteur Test');
        $this->assertSame('Auteur Test', $commentaire->getAuteur());
    }

    public function testSetAuteur()
    {
        $commentaire = new Commentaire();
        $commentaire->setAuteur('Auteur Test');
        $this->assertSame('Auteur Test', $commentaire->getAuteur());
    }

    public function testGetEmail()
    {
        $commentaire = new Commentaire();
        $commentaire->setEmail('auteur@test.com');
        $this->assertSame('auteur@test.com', $commentaire->getEmail());
    }

    public function testSetEmail()
    {
        $commentaire = new Commentaire();
        $commentaire->setEmail('auteur@test.com');
        $this->assertSame('auteur@test.com', $commentaire->getEmail());
    }

    public function testGetContenu()
    {
        $commentaire = new Commentaire();
        $commentaire->setContenu('Contenu de test');
        $this->assertSame('Contenu de test', $commentaire->getContenu());
    }

    public function testSetContenu()
    {
        $commentaire = new Commentaire();
        $commentaire->setContenu('Contenu de test');
        $this->assertSame('Contenu de test', $commentaire->getContenu());
    }

    public function testGetDate()
    {
        $commentaire = new Commentaire();
        $date = new \DateTime();
        $commentaire->setDate($date);
        $this->assertSame($date, $commentaire->getDate());
    }

    public function testSetDate()
    {
        $commentaire = new Commentaire();
        $date = new \DateTime();
        $commentaire->setDate($date);
        $this->assertSame($date, $commentaire->getDate());
    }

    public function testGetJoliDessin()
    {
        $commentaire = new Commentaire();
        $joliDessin = new JoliDessin();
        $commentaire->setJoliDessin($joliDessin);
        $this->assertSame($joliDessin, $commentaire->getJoliDessin());
    }

    public function testSetJoliDessin()
    {
        $commentaire = new Commentaire();
        $joliDessin = new JoliDessin();
        $commentaire->setJoliDessin($joliDessin);
        $this->assertSame($joliDessin, $commentaire->getJoliDessin());
    }

    public function testGetBlogPost()
    {
        $commentaire = new Commentaire();
        $blogPost = new BlogPost();
        $commentaire->setBlogPost($blogPost);
        $this->assertSame($blogPost, $commentaire->getBlogPost());
    }

    public function testSetBlogPost()
    {
        $commentaire = new Commentaire();
        $blogPost = new BlogPost();
        $commentaire->setBlogPost($blogPost);
        $this->assertSame($blogPost, $commentaire->getBlogPost());
    }
}
