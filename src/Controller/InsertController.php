<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InsertController extends AbstractController
{
    /**
     * @Route("/insert", name="insert", methods={"POST"})
     */
    public function index(Request $req): Response
    {
        // Nel caso non si usi il body della richiesta
        if ($req->getContent() === "")
        {
            
        }
        // Nel caso in cui invece si utilizza il body
        else
        {
            
        }
    }
}
