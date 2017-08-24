<?php

namespace AppBundle\Controller\Main;

use AppBundle\AppBundle;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/", name="main_homepage")
     */
    public function indexAction()
    {
        return $this->render('main/index.html.twig');
    }
}
