<?php

namespace AppBundle\Command;

use AppBundle\DataFixtures\ORM\LoadUserData;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateAdminUsersCommand extends ContainerAwareCommand
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $manager;
    private $encoder;

    protected function configure()
    {
        $this
            ->setName('app:users:populate')
            ->setDescription('Create admin users.');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->encoder = $this->getContainer()->get('security.password_encoder');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            foreach (LoadUserData::USERS as $userName => $userRole) {
                LoadUserData::generateUser($this->manager, $this->encoder, $userName, $userRole);
            }
            $this->manager->flush();
            $output->writeln('Creation of admin users was successfully completed');
        } catch (\Exception $e) {
            $output->writeln('The error occurred during execution : '.$e->getMessage());
        }
    }
}
