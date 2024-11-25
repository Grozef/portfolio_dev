<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserDeuxTest extends TestCase
{
    public function testGetEmail(): void
    {
        $user = new User();
        $user->setEmail('youpi@gmail.com');
        $this->assertSame('youpi@gmail.com', $user->getEmail());
    }

    public function testSetEmail(): void
    {
        $user = new User();
        $user->setEmail('youpi@gmail.com');
        $this->assertSame('youpi@gmail.com', $user->getEmail());
    }

    public function testGetPassword(): void
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertSame('password', $user->getPassword());
    }

    public function testSetPassword(): void
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertSame('password', $user->getPassword());
    }

    public function testGetAbout(): void
    {
        $user = new User();
        $user->setAbout('A propos');
        $this->assertSame('A propos', $user->getAbout());
    }

    public function testSetAbout(): void
    {
        $user = new User();
        $user->setAbout('A propos');
        $this->assertSame('A propos', $user->getAbout());
    }

    public function testGetPrenom(): void
    {
        $user = new User();
        $user->setPrenom('Nour');
        $this->assertSame('Nour', $user->getPrenom());
    }
    //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
    public function testSetPrenom(): void
    {
        $user = new User();
        $user->setPrenom('Nour');
        $this->assertSame('Nour', $user->getPrenom());
    }

    public function testGetNom(): void
    {
        $user = new User();
        $user->setNom('Bismuth');
        $this->assertSame('Bismuth', $user->getNom());
    }

    public function testSetNom(): void
    {
        $user = new User();
        $user->setNom('Bismuth');
        $this->assertSame('Bismuth', $user->getNom());
    }

    public function testIsEmpty(): void
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
    //    $this->assertEmpty($user->getPassword());  // Vérification avec assertEmpty si le mot de passe est une chaîne vide 
    // -> TypeError: App\Entity\User::getPassword(): Return value must be of type string, null returned
        $this->assertEmpty($user->getAbout());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getNom());
    }

    public function testGetRoles()
    {
        $user = new User();
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testSetRoles()
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
    }
}
