<?php
// lancer les test avec la commande vendor\bin\phpunit tests/

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
        //  appeller les tests en ligne de commande avec vendor/bin/phpunit tests/
    public function testIsTrue(): void 
    {
        $user = new User();

        $user->setEmail('youpi@gmail.com')
             ->setPassword('password')
             ->setAbout('A propos')
             ->setPrenom('Nour')
             ->setNom('Bismuth');

        // Vérifier si les valeurs sont bien celles définies
        $this->assertTrue($user->getEmail() === 'youpi@gmail.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getAbout() === 'A propos');
        $this->assertTrue($user->getPrenom() === 'Nour');
        $this->assertTrue($user->getNom() === 'Bismuth');
    }

    public function testIsFalse(): void 
    {
        $user = new User();

        $user->setEmail('youpi@gmail.com')
             ->setPassword('password')
             ->setAbout('A propos')
             ->setPrenom('Nour')
             ->setNom('Bismuth');

        // Vérifier que les valeurs ne correspondent pas à des valeurs incorrectes
        $this->assertFalse($user->getEmail() === 'false@gmail.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getAbout() === 'false');
        $this->assertFalse($user->getPrenom() === 'false');
        $this->assertFalse($user->getNom() === 'false');
    }

    public function testIsEmpty(): void 
    {
        $user = new User();

        // Vérifier que les attributs sont vides par défaut
        $this->assertEmpty($user->getEmail());
/*
assertNull($variable) : Vérifie que la variable est strictement égale à null. Cela signifie que la valeur n'a pas été définie
ou est explicitement null.
assertEmpty($variable) : Vérifie que la variable est "vide". Une variable est considérée comme vide si elle est null, une chaîne vide 
"", false, un tableau vide, ou le chiffre 0.
*/
        // $this->assertEmpty($user->getPassword());  // Assure-toi que ce soit une chaîne vide
        // $this->assertIsString($user->getPassword());

        // trouver un moyen de tester le password ? hash ?
        $this->assertEmpty($user->getAbout());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getNom());

    }

    /*
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

    public function testGetPassword()
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertSame('password', $user->getPassword());
    }
    */
}
