<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Match;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use \Datetime;
use \DateTimeZone;

class FetchMatchController extends Controller
{
    /**
     * @Route("/matches", name="fetch_recent_matches")
     * @Method({"GET"})
     */
    public function fetchRecentMatches(Request $request, EntityManagerInterface $entityManager)
    {
      $value = $request->query->get('recent');
      switch ($value) {
        case 0:
          $to_compare = (new DateTime())->setTime(0,0);
          break;
        case 1:
          $to_compare = (new DateTime("monday this week"))->setTime(0,0);
          break;
        case 2:
          $to_compare = (new DateTime("first day of this month"))->setTime(0,0);
          break;
      };

      $to_compare->setTimeZone(new DateTimeZone('Europe/Paris'));

      $qb = $entityManager->createQueryBuilder();
      $qb->select('m')
        ->from('App\Entity\Match', 'm')
        ->where('m.date > :date')
        ->orderBy('m.date', 'DESC')
        ->setParameter('date', $to_compare);

      $query=$qb->getQuery();

      $recent_matches = $query->getResult();

      $data = array_map(function($match){return $match->matchToJson();}, $recent_matches);


      $response = new JsonResponse(
        $data,
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }

    /**
     * @Route("/matches", name="fetch_striking_matches")
     * @Method({"GET"})
     */
    public function fetchStrikingMatches(Request $request, EntityManagerInterface $entityManager)
    {
      $value = $request->query->get('striking');
      $qb = $entityManager->createQueryBuilder();
      switch ($value) {
        case 0:
          $qb->select('m')
            ->from('App\Entity\Match', 'm')
            ->where('m.score[0] + m.score[1] > :goals')
            ->orderBy('m.date', 'DESC')
            ->setParameter('goals', 5);
          break;
        case 1:
          $qb->select('m')
            ->from('App\Entity\Match', 'm')
            ->where('m.score[0] - m.score[1] > :goals')
            ->orderBy('m.date', 'DESC')
            ->setParameter('goals', 4);
          break;
        case 2:
          $qb->select('m')
            ->from('App\Entity\Match', 'm')
            ->where('m.score[0] + m.score[1] < :goals')
            ->orderBy('m.date', 'DESC')
            ->setParameter('goals', 1);
          break;
      }

      $striking_matches = $query->getResult();

      $data = array_map(function($match){return $match->matchToJson();}, $striking_matches);


      $response = new JsonResponse(
        $data,
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
