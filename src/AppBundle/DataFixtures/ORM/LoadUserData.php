<?php


namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');

        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $password = $encoder->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($password);
        $userAdmin->setEmail('admin@admin.com');
        $userAdmin->setEnabled(true);
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($userAdmin);

        $userSuperAdmin = new User();
        $userSuperAdmin->setUsername('superadmin');
        $password = $encoder->encodePassword($userSuperAdmin, 'superadmin');
        $userSuperAdmin->setPassword($password);
        $userSuperAdmin->setEmail('superadmin@admin.com');
        $userSuperAdmin->setEnabled(true);
        $userSuperAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($userSuperAdmin);

        $manager->flush();

    }
}