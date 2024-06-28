<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $adminUsername;
    protected $adminPassword;

    public function __construct(
        $adminUsername,
        $adminPassword,
        private readonly UserPasswordHasherInterface $hasher
    )
    {
        $this->adminUsername = $adminUsername;
        $this->adminPassword = $adminPassword;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUsername($this->adminUsername)
            ->setPassword($this->hasher->hashPassword($admin, $this->adminPassword))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
    }
}
