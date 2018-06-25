<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Match;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddMatchController extends Controller
{
    /**
     * @Route("/add/match", name="add_match")
     */
    public function addMatch(Request $request_body, EntityManagerInterface $entityManager)
    {
      $request_body = json_decode(file_get_contents('php://input'));
      $match = new Match();
      $match->setPlayers($request_body->players);
      $match->setTeams($request_body->teams);
      $match->setScore($request_body->score);
      $match->setDate($request_body->date);

      $playerOne=$this->getDoctrine()
      ->getRepository(Player::class)
      ->find($request_body->players[0]);

      $playerTwo=$this->getDoctrine()
      ->getRepository(Player::class)
      ->find($request_body->players[1]);

      $playerOne->updateResultsPlayerOne($request_body->score);
      $playerTwo->updateResultsPlayerTwo($request_body->score);

      $entityManager->persist($match);
      $entityManager->persist($playerOne);
      $entityManager->persist($playerTwo);

      $entityManager->flush();

      $response = new JsonResponse(
        'added match',
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
