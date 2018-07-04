<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TeamController extends Controller
{
    /**
     * @Route("/teams", name="fetch_teams")
     * @Method({"GET"})
     */
    public function fetchTeams()
    {
      $teams = (array) $this->getDoctrine()
      ->getRepository(Team::class)
      ->findAll();

      $data = [];

      foreach($teams as $team) {
        array_push($data, [$team->teamToJson()]);
      };

      $response = new JsonResponse(
        $data,
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
