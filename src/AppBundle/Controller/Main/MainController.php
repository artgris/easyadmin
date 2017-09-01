<?php

namespace AppBundle\Controller\Main;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="main_homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @internal param Request $request
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('main/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
