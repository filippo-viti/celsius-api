<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Observations;

class ObservationController extends AbstractController
{
    /**
     * @Route("/api/observation/{pk}", name="observation")
     */
    // FIXME
    public function index(string $pk): Response
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace("%20%", " ", $url);

        $pk = new \DateTime(explode("/", $url)[3]);

        return $this->json(
            $this->getDoctrine()->getRepository(Observations::class)->find($pk)
        );
    }
}
