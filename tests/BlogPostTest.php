<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Entity\Commentaire;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class BlogPostTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $blogPost = new BlogPost();
        $now = new DateTimeImmutable();

        // Test setTitre et getTitre
        $blogPost->setTitre('Mon titre');
        $this->assertSame('Mon titre', $blogPost->getTitre());

        // Test setContenu et getContenu
        $blogPost->setContenu('Mon contenu');
        $this->assertSame('Mon contenu', $blogPost->getContenu());

        // Test setSlug et getSlug
        $blogPost->setSlug('mon-titre');
        $this->assertSame('mon-titre', $blogPost->getSlug());

        // Test setCreatedAt et getCreatedAt
        $blogPost->setCreatedAt($now);
        $this->assertSame($now, $blogPost->getCreatedAt());

        // Test setUser et getUser
        $user = new User();
        $blogPost->setUser($user);
        $this->assertSame($user, $blogPost->getUser());
    }

    public function testAddAndRemoveCommentaires()
    {
        $blogPost = new BlogPost();
        $commentaire = new Commentaire();

        // Test addCommentaire
        $blogPost->addCommentaire($commentaire);
        $this->assertCount(1, $blogPost->getCommentaires());
        $this->assertSame($blogPost, $commentaire->getBlogPost());

        // Test removeCommentaire
        $blogPost->removeCommentaire($commentaire);
        $this->assertCount(0, $blogPost->getCommentaires());
        $this->assertNull($commentaire->getBlogPost());
    }

        //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
}
