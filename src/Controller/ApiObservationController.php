<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Entity\Observations;
use App\Form\ObservationsType;
use App\Repository\ObservationsRepository;

/**
 * @Route("/api/observation")
 */
class ApiObservationController extends AbstractController
{
    /**
     * @Route("/last", name="observation_last", methods={"GET"})
     */
    public function getLastObservation(Request $request, ObservationsRepository $rep): Response
    {    
        $data = $rep->findLast();

        return $this->response($request, $data);
    }
    
    /**
     * @Route("/{time?}", name="observation_get", methods={"GET"})
     */
    public function getObservation(Request $request, string $time = null): Response
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);
    
        if ($time)
        {
            $data = $repository->findOneBy(
                [
                    'time' => (new \DateTime($time))->format("Y-m-d H:i:s")
                ]
            );
        }
        else
        {
            $data = $repository->findAll();
        }

        return $this->response($request, $data);
    }

    /**
     * @Route("/get-by-day/{day}", name="get_by_day", methods={"GET"})
     */
    public function getObservationsByDay (Request $req, string $day, ObservationsRepository $rep): Response
    {
        $data = $rep->findByDay((new \DateTime($day))->format("Y-m-d"));

        return $this->response($req, $data);
    }

    /**
     * @Route("/get-by-month/{year}/{month}", name="get_by_month", methods={"GET"})
     */
    public function getObservationsByMonth (Request $req, int $year, int $month, ObservationsRepository $rep): Response
    {
        $data = $rep->findByMonth($year, $month);

        return $this->response($req, $data);
    }
    
    /**
     * @Route("/get-by-year/{year}", name="get_by_year", methods={"GET"})
     */
    public function getObservationsByYear (Request $req, int $year, ObservationsRepository $rep): Response
    {
        $data = $rep->findByYear($year);

        return $this->response($req, $data);
    }

    /**
     * @Route("/get-from-day-to-day/{day1}/{day2}", name="observation_getFromDayToDay", methods={"GET"})
     */
    public function getObservationFromDayToDay(Request $request, string $day1, string $day2)
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        if ($day1 > $day2)
        {
            return $this->response($request, null, "Day $day1 is not < than day $day2", 400);
        }

        $day1 = (new \DateTime($day1))->format("Y-m-d");
        $day2 = (new \DateTime($day2))->format("Y-m-d");

        return $this->response($request, $repository->findBetweenTwoDays($day1, $day2));
    }

    /**
     * @Route("/get-avg-on/{day}/{field}", methods={"GET"})
     */
    public function getAvgOn(Request $req, string $day, string $field, ObservationsRepository $rep): Response
    {
        return $this->response($req, $rep->findAvgOn($day, $field));
    }

    /**
     * @Route("/get-year-avg/{year}/{field}", methods={"GET"})
     */
    public function getYearAvg(Request $req, int $year, string $field, ObservationsRepository $rep)
    {
        return $this->response($req, $rep->findYearAvg($field, $year));
    }

    /**
     * @Route("/get-from-month-to-month/{year1}/{month1}/{year2}/{month2}", name="observation_getFromMonthToMonth", methods={"GET"})
     */
    public function getObservationFromMonthToMonth(Request $request, int $year1, int $month1, int $year2, int $month2)
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        if ($year1 > $year2)
        {
            return $this->response($request, null, "Year $year1 is not < than year $year2", 400);
        }
        else if ($year1 == $year2 && $month1 > $month2) 
        {
            return $this->response($request, null, "Month $month1 is not < than month $month2", 400);
        }

        return $this->response($request, $repository->findBetweenTwoMonths($year1, $month1, $year2, $month2));
    }

    /**
     * @Route("/get-from-year-to-year/{year1}/{year2}", name="observation_getFromYearToYear", methods={"GET"})
     */
    public function getObservationFromYearToYear(Request $request, int $year1, int $year2)
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        if ($year1 > $year2)
        {
            return $this->response($request, null, "Year $year1 is not < than year $year2", 400);
        }

        return $this->response($request, $repository->findBetweenTwoYears($year1, $year2));
    }
    
    /**
     * @Route("/{from}/{to}", name="observation_getFromTo", methods={"GET"})
     */
    public function getObservationFromTo(Request $request, string $from, string $to)
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        return $this->response($request ,$repository->findAllBetween($from, $to));
    }

    /**
     * @Route("/", name="observation_post", methods={"POST"})
     */
    public function createObservation(Request $req, LoggerInterface $logger): Response
    {
        $data = json_decode($req->getContent(), true);

        if ($this->exists($data["time"]))
        {
            return $this->response($req,[], "The resource already exists", 409);
        }

        $manager = $this->getDoctrine()->getManager();

        $o = $this->validateForm($data);

        if ($o !== null)
        {
            $manager->persist($o);
            $manager->flush();

            return $this->response(
                $this->getDoctrine()->getRepository(Observations::class)->findOneBy($data["time"]),
                null,
                201
            )->headers->set("Location", "/api/observations/$data[time]");
        }
        
        return $this->response($req, [], "Bad request", 400);
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

            return $this->response(
                $req, $this->getDoctrine()->getRepository(Observations::class)->findOneBy($data["time"])
            );
        }

        return $this->error([], "Bad request", 400);
    }

    /**
     * @Route("/{pk}", name="observation_delete", methods={"DELETE"})
     */
    public function deleteObservation(Request $request, string $pk)
    {
        $repository = $this->getDoctrine()->getRepository(Observations::class);

        $o = $repository->find(intval($pk));

        if ($o != null)
        {
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($o);
            $manager->flush();

            return $this->response($request, [], null, 204);
        }

        return $this->response($request , [], "Resource not found", 404);
    }

    private function validateForm(array $data) : Observations
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

    private function response($request, $data, $message = null, $status_code = 200): Response
    {
        if ($message != null)
        {
            $data["error"] = $message;
        }

        $response = $this->json($data, $status_code);
		$response->headers->set("Access-Control-Allow-Origin", $request->headers->get("host"));
		$response->headers->set("Access-Control-Allow-Credentials", "true");

        return $response;
    }
}