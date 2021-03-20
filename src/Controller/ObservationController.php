<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObservationController extends AbstractController
{
    /**
     * @Route("/observation", name="observation")
     */
    public function index(): Response
    {
        return $this->render('observation/index.html.twig', [
            'controller_name' => 'ObservationController',
        ]);
    }
}
