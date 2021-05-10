<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    protected $faker = null;
    protected $encrypt;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = \Faker\Factory::create($locale = 'fr_FR');
        $this->encrypt=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Utilisateur();

        $user->setUsername('admin');
        $user->setNom('Admin');
        $user->setPrenom('Admin');
        $user->setPassword($this->encrypt->encodePassword($user, 'admin'));
        $user->setEmail('admin@gmail.com');

        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);

        $manager->persist($user);

        for($i=0; $i < 3; $i++){
            $employee = new Utilisateur();

            $employee->setPrenom($this->faker->firstName);
            $employee->setNom($this->faker->lastName);
            $employee->setUsername($this->faker->firstName);
            $employee->setPassword($this->encrypt->encodePassword($employee, 'test'));
            $employee->setEmail($this->faker->email);

            $roles = ['ROLE_USER'];
            $user->setRoles($roles);

            $manager->persist($employee);
        }
        $manager->flush();
    }
}

