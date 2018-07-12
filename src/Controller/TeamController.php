<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

      $data = array_map(function($team){return $team->teamToJson();}, $teams);

      $response = new JsonResponse(
        $data,
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }

    /**
     * @Route("/teams", name="add_team")
     * @Method({"POST"})
     */
    public function addTeam(Request $request, EntityManagerInterface $entityManager)
    {
      $request_body = json_decode($request->getContent());

      $team = new Team();
      $team->setName($request_body->name);

      $entityManager->persist($team);

      $entityManager->flush();

      $response = new JsonResponse(
        $team->teamToJson(),
        201,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
