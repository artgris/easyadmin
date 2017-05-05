<?php


namespace AppBundle\Controller\Admin;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class UserController extends BaseAdminController
{

    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

//
//    public function duplicateAction()
//    {
//        $id = $this->request->query->get('id');
//
//        $entity = clone $this->em->getRepository('AppBundle:User')->find($id);
//        $entity->setUsername($entity->getUsername()."-1");
//        $entity->setEmail($entity->getEmail()."-1");
//        $this->em->persist($entity);
//        $this->em->flush();
//        return $this->redirectToRoute('easyadmin', array(
//            'action' => 'list',
//            'entity' => $this->request->query->get('entity'),
//        ));
//    }

}