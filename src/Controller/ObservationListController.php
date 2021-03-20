<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObservationListController extends AbstractController
{
    /**
     * @Route("/api/observation/list", name="observation_list")
     */
    public function index(): Response
    {
        return $this->json(
            
        );
    }
}
