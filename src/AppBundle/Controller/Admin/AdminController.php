<?php

namespace AppBundle\Controller\Admin;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class AdminController extends BaseAdminController
{
    private function move(Request $request, $position)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $entityName = $request->query->get('entity');
        $entity = $em->getRepository("AppBundle:{$entityName}")->find($id);

        if ($entity !== null) {
            $entity->setPosition($entity->getPosition() + $position);
            $em->persist($entity);
            $em->flush();
        }

        return $this->redirectToRoute('easyadmin', [
            'action' => 'list',
            'entity' => $request->query->get('entity'),
            'sortField' => 'position',
            'sortDirection' => 'ASC',
        ]);
    }

    /**
     * @Route("/admin/moveUp", name="admin_move_up")
     */
    public function moveUpAction(Request $request)
    {
        return $this->move($request, -1);
    }

    /**
     * @Route("/admin/moveDown", name="admin_move_down")
     */
    public function moveDownAction(Request $request)
    {
        return $this->move($request, 1);
    }
}
