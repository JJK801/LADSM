<?php

namespace JJK801\Bundle\LADSMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JJK801LADSMBundle:Default:index.html.twig');
    }
}
