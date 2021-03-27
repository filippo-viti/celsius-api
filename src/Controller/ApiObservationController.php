<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Observations;
use App\Form\ObservationsType;

/**
 * @Route("/api/observation")
 */
class ApiObservationController extends AbstractController
{
    /**
     * @Route("/{time?}", name="observation_get", methods={"GET"})
     */
    public function getObservation($time = null): Response
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
     * @Route("/", name="observation_post", methods={"POST"})
     */
    public function createObservation(Request $req) : Response
    {
        $data = json_decode($req->getContent(), true);

        if ($this->exists($data["time"]))
        {
            return $this->error("The resource already exists", 409);
        }

        $manager = $this->getDoctrine()->getManager();

        $o = $this->validateForm($data);

        if ($o !== null)
        {
            $manager->persist($c);
            $manager->flush();

            return $this->json(
                [
                    "status_code" => 200
                ]
            , 200);
        }
        
        return $this->error("Bad request", 400);
    }

    /**
     * @Route("/{pk}", name="observation_put", methods={"PUT"})
     */
    public function updateObservation(Request $req)
    {
        $data = json_decode($req->getContent(), true);

        $manager = $this->getDoctrine()->getManager();

        $o = $this->validateForm($data);

        if ($o !== null)
        {
            $manager->persist($o);
            $manager->flush();

            return $this->json(
                [
                    "status_code" => 200
                ]
            , 200);
        }

        return $this->error("Bad request", 400);
    }

    /**
     * @Route("/{pk}", name="observation_delete", methods={"DELETE"})
     */
    public function deleteObservation(string $pk)
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        $o = $repository->find(intval($pk));

        if ($o != null)
        {
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($o);
            $manager->flush();

            return $this->json([
                "status_code" => 200
            ], 200);
        }

        return $this->error("Resource not found", 404);
    }

    private function validateForm(array $data) : Observation
    {
        $c = new Observations();
        $form = $this->createForm(ObservationsType::class, $c); // di default il terzo parametro sarebbe ["method" => "POST"]

        $form->submit($data);

        return $form->isValid() ? $c : null;
    }

    private function exists($pk) : bool
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        return $repository->find($pk) ? true : false;
    }
    
    private function error(string $message, int $status_code)
    {
        return $this->json(
            [
                "error" => $message
            ]
        , $status_code);
    }
}