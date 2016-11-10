<?php

namespace Partfire\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PartfireCommonBundle:Default:index.html.twig');
    }
}
