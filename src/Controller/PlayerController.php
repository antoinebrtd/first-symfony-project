<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
// ...
use Symfony\Component\HttpFoundation\Request;
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
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $entityManager)

        $player = new Player();
        $player->setName('Tutur');
        $player->setPlayed(0);
        $player->setWins(0);
        $player->setDraws(0);
        $player->setLosses(0);
        $player->setPoints(0);
        $player->setGoaldiff(0);
        $player->setFor(0);
        $player->setAgainst(0);
        $player->setTrophies([]);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($player);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('AddPlayer.html.twig', array(
          'id' => $player->getId(),
        ));
    }

    // if you have multiple entity managers, use the registry to fetch them
    public function editAction()
    {
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();
        $otherEntityManager = $doctrine->getManager('other_connection');
    }

    /**
     * @Route("/players/display/{id}", name="player_display")
     */
    public function displayPlayer($id)
    {
      $player = $this->getDoctrine() //lancer la co avec doctrine
      ->getRepository(Player::class) //va me chercher les requetes de base sur player
      ->find($id); //equivalent du select

      $repository = $this->getDoctrine()
      ->getRepository(Player::class);

      //$player = $repository->find(6); pareil qu'au dessus

      //$player = $repository->findOneById(6); pareil qu'au dessus

      $response = new JsonResponse(
        $player->toJson(),
        200,
        array('access-control-allow-origin' => '*')
      );

      return $response;
    }
}
