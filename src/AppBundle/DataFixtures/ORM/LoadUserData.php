<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    const USERS = [
        'admin' => ['ROLE_ADMIN'],
        'superadmin' => ['ROLE_SUPER_ADMIN'],
    ];

    private $encoder;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->encoder = $container->get('security.password_encoder');
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this::USERS as $userName => $userRole) {
            $this->generateUser($manager, $this->encoder, $userName, $userRole);
        }
        $manager->flush();
    }

    public static function generateUser(ObjectManager $manager, UserPasswordEncoder $encoder, $userName, array $userRole)
    {
        $user = new User();
        $user->setUsername($userName);
        $password = $encoder->encodePassword($user, $userName);
        $user->setPassword($password);
        $user->setEmail($userName.'@admin.com');
        $user->setEnabled(true);
        $user->setRoles($userRole);
        $manager->persist($user);
    }
}
