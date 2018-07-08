<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Match;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use \Datetime;
use \DateTimeZone;

class FetchMatchController extends Controller
{
    /**
     * @Route("/matches/recent/{value}", name="fetch_recent_matches")
     * @Method({"GET"})
     */
    public function fetchRecentMatches(EntityManagerInterface $entityManager, $value)
    {
      switch ($value) {
        case 0:
          $to_compare = (new DateTime())->setTime(0,0);
          $to_compare->setTimeZone(new DateTimeZone('Europe/Paris'));
          break;
        case 1:
          $to_compare = (new DateTime("monday this week"))->setTime(0,0);
          $to_compare->setTimeZone(new DateTimeZone('Europe/Paris'));
          break;
        case 2:
          $to_compare = (new DateTime("first day of this month"))->setTime(0,0);
          $to_compare->setTimeZone(new DateTimeZone('Europe/Paris'));
          break;
      }
      $query = $entityManager->createQuery(
        'SELECT m
        FROM App\Entity\Match m
        WHERE m.date > :date
        ORDER BY m.date DESC'
      )->setParameter('date', $to_compare);
      $recent_matches = $query->getResult();

      $data = [];
      foreach($recent_matches as $match) {
        array_push($data, [$match->matchToJson()]);
      };


      $response = new JsonResponse(
        $data,
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
