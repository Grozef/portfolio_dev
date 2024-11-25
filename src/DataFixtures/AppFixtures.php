<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use App\Entity\User;
use App\Entity\UserInfo;
use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Categorie;
use App\Entity\JoliDessin;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('fr_FR');
        $this->hasher = $hasher; // Injecting password hashing service
    }

    public function load(ObjectManager $manager): void
    {
        // Creating users
        $users = $this->createUsers($manager, 24);

        // Creating admin
        $this->createAdmin($manager);

        // Creating categories
        $categories = $this->createCategories($manager, 5);

        // Creating BlogPosts
        $this->createBlogPosts($manager, $users, 15);

        // Creating JoliDessins
        $this->createJoliDessins($manager, $users, $categories, 20);

        // Creating ContactMessages
        $contact = $this->createContactMessages($manager);

        // Saving to the database
        $manager->flush();
    }

    private function createUsers(ObjectManager $manager, int $count): array
    {
        $users = [];
        $userInfos = [];
        for ($i = 0; $i < $count; $i++) {
            $user = new User();
            $user->setNom($this->faker->lastName()) // Using last name for the name
                ->setPrenom($this->faker->firstName())
                ->setEmail($this->faker->unique()->email()) // Unique email
                ->setRoles(['ROLE_USER'])
                ->setAbout('I\'m a user');

            // Hashing the password
            $hashedPassword = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($hashedPassword);

            // Creating corresponding UserInfo
            $userInfo = new UserInfo();
            $userInfo->setDirection($this->faker->streetAddress())
                ->setPostalCode($this->faker->postcode())
                ->setTown($this->faker->city())
                ->setCountry($this->faker->country())
                ->setTel($this->faker->phoneNumber())
                ->setInstagram($this->faker->userName())
                ->setFacebook($this->faker->userName())
                ->setTiktok($this->faker->userName())
                ->setSnapchat($this->faker->userName())
                ->setTwitter($this->faker->userName())
                ->setPinterest($this->faker->userName())
                ->setYoutube($this->faker->userName())

                ->setRelation($user); // Set the relation to the user


            $users[] = $user;
            $userInfos[] = $userInfo;
            $manager->persist($userInfo);
            $manager->persist($user);
        }

        return $users;
    }

    private function createAdmin(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setNom('Steve')
            ->setPrenom('Steve')
            ->setEmail('steve@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAbout('I\'m Steve');

        // Hashing the password for admin
        $hashedPassword = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($hashedPassword);

        // Creating corresponding UserInfo for admin
        $adminInfo = new UserInfo();
        $adminInfo->setDirection($this->faker->streetAddress())
            ->setPostalCode($this->faker->postcode())
            ->setTown($this->faker->city())
            ->setCountry($this->faker->country())
            ->setTel($this->faker->phoneNumber())
            ->setInstagram($this->faker->userName())
            ->setFacebook($this->faker->userName())
            ->setTiktok($this->faker->userName())
            ->setSnapchat($this->faker->userName())
            ->setTwitter($this->faker->userName())
            ->setPinterest($this->faker->userName())
            ->setYoutube($this->faker->userName())

            ->setRelation($admin); // Set the relation to the admin

        $manager->persist($adminInfo);
        $manager->persist($admin);
    }

    private function createCategories(ObjectManager $manager, int $count): array
    {
        $categories = [];
        for ($i = 0; $i < $count; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($this->faker->word())
                ->setSlug($this->faker->unique()->slug()) // Unique slug
                ->setDescription($this->faker->paragraph());

            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        return $categories;
    }

    private function createBlogPosts(ObjectManager $manager, array $users, int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $blogPost = new BlogPost();
            $blogPost->setTitre($this->faker->sentence(5))
                ->setContenu($this->faker->paragraphs(3, true))
                ->setSlug($this->faker->unique()->slug()) // Unique slug
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUser($this->faker->randomElement($users));

            $manager->persist($blogPost);

            // Creating comments for each BlogPost
            $this->createCommentsForBlogPost($manager, $blogPost, $users);
        }
    }

    private function createCommentsForBlogPost(ObjectManager $manager, BlogPost $blogPost, array $users): void
    {
        for ($j = 0; $j < mt_rand(1, 5); $j++) {
            $commentaire = new Commentaire();
            $user = $this->faker->randomElement($users);
            $commentaire->setContenu($this->faker->paragraph())
                ->setBlogPost($blogPost)
                ->setAuteur($user->getNom())
                ->setDate($this->faker->dateTimeBetween('-1 month', 'now'))
                ->setEmail($user->getEmail()); // Use the user's email

            $manager->persist($commentaire);
        }
    }

    private function createJoliDessins(ObjectManager $manager, array $users, array $categories, int $count): void
    {
        // image directory
        $imageDir = 'public/assets/img/glops';
        
        // Récupérer tous les fichiers dans le répertoire
        $files = scandir($imageDir);
        
        // Filter to keep only image extensions ( jpg, jpeg and png)
        $imageFiles = array_filter($files, function($file) {
            return preg_match('/\.(jpg|jpeg|png)$/i', $file);
        });
    
        // associative array to link name and image
        $imageMappings = [];
        foreach ($imageFiles as $file) {
            // use fileName as the name of the image
            $nameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
            $imageMappings[$nameWithoutExtension] = $file;
        }
    
        $keys = array_keys($imageMappings); // fetch the keys (imageName)
    
        for ($i = 0; $i < $count; $i++) {
            // Pick a random imageName
            $nomDessin = $this->faker->randomElement($keys);
            
            $dessin = new JoliDessin();
            $dessin->setNom($nomDessin) // image name
                ->setHauteur($this->faker->randomFloat(2, 10, 100))
                ->setLargeur($this->faker->randomFloat(2, 10, 100))
                ->setVente($this->faker->boolean())
                ->setPrix($this->faker->randomFloat(2, 50, 500))
                ->setCreaDate($this->faker->dateTimeThisYear())
                ->setMelDate($this->faker->dateTimeThisYear())
                ->setDescription($this->faker->paragraph())
                ->setPortfolio($this->faker->boolean())
                ->setSlug($this->faker->unique()->slug()) // Unique slug
                ->setFile($imageMappings[$nomDessin]) // image
                ->setUser($this->faker->randomElement($users));
    
            // Associating randomly between 1 and 3 categories
            $randomCategories = (array) $this->faker->randomElements($categories, mt_rand(1, 3));
            foreach ($randomCategories as $categorie) {
                $dessin->addCategorie($categorie);
            }
    
            // Creating comments for each drawing
            $this->createCommentsForJoliDessin($manager, $dessin, $users);
    
            $manager->persist($dessin);
        }
    }
    
    private function createCommentsForJoliDessin(ObjectManager $manager, JoliDessin $dessin, array $users): void
    {
        for ($j = 0; $j < mt_rand(1, 5); $j++) {
            $user = $this->faker->randomElement($users); // Selecting a random user
            $commentaire = new Commentaire();
            $commentaire->setAuteur($user->getNom()) // Use the user's name
                ->setEmail($user->getEmail()) // Use the user's email
                ->setContenu($this->faker->paragraph())
                ->setDate($this->faker->dateTimeBetween('-1 month', 'now'))
                ->setJoliDessin($dessin);

            $manager->persist($commentaire);
            $dessin->addCommentaire($commentaire);
        }
    }

    private function createContactMessages(ObjectManager $manager){
            // Contact
            for ($i = 0; $i < 5; $i++) {
                $contact = new Contact();
                $contact->setNom($this->faker->lastName())
                    ->setPrenom($this->faker->firstName())
                    ->setEmail($this->faker->email())
                    ->setSubject('Demande n°' . ($i + 1))
                    ->setMessage($this->faker->text())
                    ->setCreatedAt($this->faker->dateTimeThisYear());
    
                $manager->persist($contact);
            }
        }
}
