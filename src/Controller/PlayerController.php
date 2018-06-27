<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    /**
     * @Route("/add/player", name="add_player")
     */
    public function addPlayer(EntityManagerInterface $entityManager)
    {
      $request_body = json_decode(file_get_contents('php://input'));
      $player = new Player();
      $player->setName($request_body->player);
      $player->setPlayed(0);
      $player->setWins(0);
      $player->setDraws(0);
      $player->setLosses(0);
      $player->setPoints(0);
      $player->setGoaldiff(0);
      $player->setFor(0);
      $player->setAgainst(0);
      $player->setTrophies([]);

      $entityManager->persist($player);

      $entityManager->flush();

      $response = new JsonResponse(
        'added player',
        200,
        array('access-control-allow-origin' => '*')
      );

      return $Response;
    }

    /**
     * @Route("/fetch/players", name="fetch_players")
     */
    public function fetchPlayers()
    {
      $players = (array) $this->getDoctrine()
      ->getRepository(Player::class)
      ->findAll();

      $data = [];

      foreach($players as $player) {
        array_push($data, [$player->getId() => $player->toJson()]);
      };

      $response = new JsonResponse(
        $data,
        200,
        array('accless-control-allow-origin' => '*')
      );

      return $response;
    }
}
