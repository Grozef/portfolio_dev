<?php

// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Entity\Commentaire;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class BlogPostTestDeux extends TestCase
{
    public function testGetTitre()
    {
        $blogPost = new BlogPost();
        $blogPost->setTitre('Mon titre');
        $this->assertSame('Mon titre', $blogPost->getTitre());
    }

    public function testSetTitre()
    {
        $blogPost = new BlogPost();
        $blogPost->setTitre('Mon titre');
        $this->assertSame('Mon titre', $blogPost->getTitre());
    }

    public function testGetContenu()
    {
        $blogPost = new BlogPost();
        $blogPost->setContenu('Mon contenu');
        $this->assertSame('Mon contenu', $blogPost->getContenu());
    }

    public function testSetContenu()
    {
        $blogPost = new BlogPost();
        $blogPost->setContenu('Mon contenu');
        $this->assertSame('Mon contenu', $blogPost->getContenu());
    }

    public function testGetSlug()
    {
        $blogPost = new BlogPost();
        $blogPost->setSlug('mon-titre');
        $this->assertSame('mon-titre', $blogPost->getSlug());
    }

    public function testSetSlug()
    {
        $blogPost = new BlogPost();
        $blogPost->setSlug('mon-titre');
        $this->assertSame('mon-titre', $blogPost->getSlug());
    }

    public function testGetCreatedAt()
    {
        $blogPost = new BlogPost();
        $now = new DateTimeImmutable();
        $blogPost->setCreatedAt($now);
        $this->assertSame($now, $blogPost->getCreatedAt());
    }

    public function testSetCreatedAt()
    {
        $blogPost = new BlogPost();
        $now = new DateTimeImmutable();
        $blogPost->setCreatedAt($now);
        $this->assertSame($now, $blogPost->getCreatedAt());
    }

    public function testGetUser()
    {
        $blogPost = new BlogPost();
        $user = new User();
        $blogPost->setUser($user);
        $this->assertSame($user, $blogPost->getUser());
    }

    public function testSetUser()
    {
        $blogPost = new BlogPost();
        $user = new User();
        $blogPost->setUser($user);
        $this->assertSame($user, $blogPost->getUser());
    }

    public function testAddCommentaire()
    {
        $blogPost = new BlogPost();
        $commentaire = new Commentaire();
        $blogPost->addCommentaire($commentaire);
        $this->assertCount(1, $blogPost->getCommentaires());
        $this->assertSame($blogPost, $commentaire->getBlogPost());
    }

    public function testRemoveCommentaire()
    {
        $blogPost = new BlogPost();
        $commentaire = new Commentaire();
        $blogPost->addCommentaire($commentaire);
        $blogPost->removeCommentaire($commentaire);
        $this->assertCount(0, $blogPost->getCommentaires());
        $this->assertNull($commentaire->getBlogPost());
    }

    //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/

}
