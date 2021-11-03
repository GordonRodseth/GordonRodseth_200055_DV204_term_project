<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\Post;
use App\Entity\User;

class PostTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     * @depends testUserCreation
     */
    private $entityManager;

    protected function setUp(): void //sets up doctrine manager for us
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
                                    ->get('doctrine')
                                    ->getManager();
    }

    //test if our entity adds a user to the db successfully
    public function testPostCreation(): void
    {
        $Post = new Post();

        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => "test@email.com"]);

        $Post->setTitle("test title");
        $Post->setContent("test content");
        $Post->setPoster($user);

        //TODO: Assert to ensure the email doesn't already exist

        //assert that all the values are strings
        $this->assertIsString($Post->getTitle());
        $this->assertIsString($Post->getContent());
        //$this->assertIsEntity($Post->getPoster());

        //update our db
        $this->entityManager->persist($userProfile);
        $this->entityManager->flush();

    }


}
