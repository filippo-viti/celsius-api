<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Observations;

class ApiObservationController extends AbstractController
{
    /**
     * @Route("/api/observation/{pk?}", name="api_observation", methods={"GET"})
     */
    public function index($pk = null): Response
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);
        
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
        }
    }
}
