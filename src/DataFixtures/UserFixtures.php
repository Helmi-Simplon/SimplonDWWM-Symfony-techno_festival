<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User;
        $user->setEmail('user@user.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'motdepasse'));

        $manager->persist($user);

        $user = new User;
        $user->setEmail('admin@admin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'motdepasse'));

        $manager->persist($user);

        $manager->flush();
    }
}
