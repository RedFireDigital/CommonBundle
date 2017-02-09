<?php

namespace PartFire\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseController extends Controller
{
   
    protected function throw404()
    {
        throw new NotFoundHttpException('Not Found');
    }
    
    protected function throwBadError($msg = "Not allowed", $code = 403)
    {
        throw new HttpException($code, $msg);
    }
}
