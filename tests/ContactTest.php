<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;
use DateTime;

class ContactTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $contact = new Contact();

        $contact->setNom('Doe');
        $this->assertEquals('Doe', $contact->getNom());

        $contact->setPrenom('John');
        $this->assertEquals('John', $contact->getPrenom());

        $contact->setEmail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $contact->getEmail());

        $contact->setMessage('Hello, this is a test message.');
        $this->assertEquals('Hello, this is a test message.', $contact->getMessage());

        $contact->setSubject('Test Subject');
        $this->assertEquals('Test Subject', $contact->getSubject());

        $dateTime = new \DateTime();
        $contact->setCreatedAt($dateTime);
        $this->assertEquals($dateTime, $contact->getCreatedAt());
    }

    public function testCreatedAtIsSetAutomatically()
    {
        $contact = new Contact();

        $this->assertNotNull($contact->getCreatedAt());

        $this->assertInstanceOf(\DateTime::class, $contact->getCreatedAt());
    }

    public function testEmailValidation()
    {
        $contact = new Contact();

        // Test a valid email adress
        $contact->setEmail('valid.email@example.com');
        $this->assertMatchesRegularExpression('/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $contact->getEmail());

        // Test an invalid email adress
        $contact->setEmail('invalid-email');
        $this->assertDoesNotMatchRegularExpression('/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $contact->getEmail());
    }

    public function testCreatedAtIsAutomaticallySet()
    {
        $contact = new Contact();

        $this->assertInstanceOf(DateTime::class, $contact->getCreatedAt());
        $this->assertEquals((new DateTime())->format('Y-m-d'), $contact->getCreatedAt()->format('Y-m-d'));
    }
}
