<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\AnnotationsasRest;
use Symfony\Component\Routing\Annotation\Route;

class InsertController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/insert")
     * 
     * @return Response
     */
    public function postAction(Request $req)
    {
        // Nel caso non si usi il body della richiesta
        if ($req->getContent() === "")
        {
            return $this->handleView();
        }
        // Nel caso in cui invece si utilizza il body
        else
        {
            
        }
    }
}
