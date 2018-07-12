<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PlayerController extends Controller
{
    /**
     * @Route("/players", name="fetch_players")
     * @Method({"GET"})
     */
    public function fetchPlayers()
    {
      $players = (array) $this->getDoctrine()
      ->getRepository(Player::class)
      ->findAll();

      $data = array_map(function($player){return $player->playerToJson();}, $players);

      $response = new JsonResponse(
        $data,
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
