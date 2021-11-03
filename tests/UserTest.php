<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\User;

class UserTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
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
    public function testUserCreation(): void
    {
        $userProfile = new User();

        $userProfile->setUsername("test_user2");
        $userProfile->setEmail("test2@email.com");
        $userProfile->setPassword("123456");

        //TODO: Assert to ensure the email doesn't already exist

        //assert that all the values are strings
        $this->assertIsString($userProfile->getUsername());
        $this->assertIsString($userProfile->getEmail());
        $this->assertIsString($userProfile->getPassword());

        //update our db
        $this->entityManager->persist($userProfile);
        $this->entityManager->flush();

    }

    //test if we can find the correct user using the email
    /**
     * @depends testUserCreation
     */
    public function testSearchByEmail(): void
    {
        $userProfile = $this->entityManager
                        ->getRepository(User::class)
                        ->findOneBy(['email' => "test2@email.com"]);

        //assert if the values are correct
        $this->assertEquals("test2@email.com", $userProfile->getEmail());
        $this->assertEquals("test_user2", $userProfile->getUsername());
        $this->assertSame("123456", $userProfile->getPassword());

        $this->entityManager->remove($userProfile);

    }

    protected function tearDown(): void 
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
    
}
