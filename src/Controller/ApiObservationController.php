<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Observations;

/**
 * @Route("/api/observation")
 */
class ApiObservationController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/{time?}", name="observation_get")
     */
    public function index ($time = null): Response
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);
        
        if ($time)
        {
            return $this->json(
                $repository->findOneBy(
                    [
                        'time' => (new \DateTime($time))->format("Y-m-d H:i:s")
                    ]
                )
            );
        }
        else
        {
            return $this->json(
                $repository->findAll()
            );
        }
    }

    /**
     * @Rest\Post("/", name="observation_post")
     */
    public function indexPost (Request $req)
    {

    }

    /**
     * @Rest\Put("/{pk}", name="observation_put")
     */
    public function indexPut (Request $req)
    {

    }

    /**
     * @Rest\Delete("/{pk}", name="observation_delete")
     */
    public function indexDelete (Request $req)
    {

    }
}
