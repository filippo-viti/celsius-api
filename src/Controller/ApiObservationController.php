<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Observations;
use App\Form\ObservationsType;

/**
 * @Route("/api/observation")
 */
class ApiObservationController extends AbstractController
{
    /**
     * @Route("/{time?}", name="observation_get")
     * @Method("GET")
     */
    public function index ($time = null): Response
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);
    
        if ($time)
        {
            $data = $repository->findOneBy(
                [
                    'time' => new \DateTime($time)
                ]
            );
        }
        else
        {
            $data = $repository->findAll();
        }

        return $this->json($data);
    }

    /**
     * @Route("/", name="observation_post")
     * @Method("POST")
     */
    public function indexPost (Request $req) : Response
    {
        $data = json_decode($req->getContent(), true);

        $c = new Observations();
        $form = $this->createForm(ObservationsType::class, $c); // di default il terzo parametro sarebbe ["method" => "POST"]

        $form->submit($data);

        $manager = $this->getDoctrine()->getManager();

        if ($form->isValid())
        {
            $manager->persist($c);
            $manager->flush();

            return $this->json(
                [
                    "status" => "200 ok"
                ]
            );
        }

        return $this->json(
            ["errore" => "I dati non sono stati inseriti"]
        );
    }

    /**
     * @Route("/{pk}", name="observation_put")
     * @Method("PUT")
     */
    public function indexPut (Request $req)
    {

    }

    /**
     * @Route("/{pk}", name="observation_delete")
     * @Method("DELETE")
     */
    public function indexDelete (Request $req)
    {

    }
}
