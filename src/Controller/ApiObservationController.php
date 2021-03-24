<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Entity\Observations;

class ApiObservationController extends AbstractFOSRestController
{
    /**
     * @Route("/api/observation/{pk?}", name="api_observation")
     * @Method("GET")
     */
    public function index($pk = null): Response
    {
        /*$repository = $this->getDoctrine()->getRepository(Observations::class);
        
        if ($pk)
        {
            return $this->json(
                $repository->find((new \DateTime($pk))->format("Y-m-d H:i:s"))
            );
        }
        else
        {
            return $this->json(
                $repository->findAll()
            );
        }*/
    }
}
