<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="players")
 */
class Player
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $played;

    /**
     * @ORM\Column(type="integer")
     */
    private $wins;

    /**
     * @ORM\Column(type="integer")
     */
    private $draws;

    /**
     * @ORM\Column(type="integer")
     */
    private $losses;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="integer")
     */
    private $goaldiff;

    /**
     * @ORM\Column(name="player_for", type="integer")
     */
    private $for;

    /**
     * @ORM\Column(name="player_against", type="integer")
     */
    private $against;

    /**
     * @ORM\Column(type="array")
     */
    private $trophies;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPlayed()
    {
        return $this->played;
    }

    public function getWins()
    {
        return $this->wins;
    }

    public function getDraws()
    {
        return $this->draws;
    }

    public function getLosses()
    {
        return $this->losses;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getGoaldiff()
    {
        return $this->goaldiff;
    }

    public function getFor()
    {
        return $this->for;
    }

    public function getAgainst()
    {
        return $this->against;
    }

    public function getTrophies()
    {
        return $this->trophies;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPlayed($played)
    {
        $this->played = $played;
    }

    public function setWins($wins)
    {
        $this->wins = $wins;
    }

    public function setDraws($draws)
    {
        $this->draws = $draws;
    }

    public function setLosses($losses)
    {
        $this->losses = $losses;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    public function setGoaldiff($goaldiff)
    {
        $this->goaldiff = $goaldiff;
    }

    public function setFor($for)
    {
        $this->for = $for;
    }

    public function setAgainst($against)
    {
        $this->against = $against;
    }

    public function setTrophies($trophies)
    {
        $this->trophies = $trophies;
    }

    public function toJson()
    {
      return [
        "id" => $this->id,
        "name" => $this->name,
        "played" => $this->played,
        "wins" => $this->wins,
        "draws" => $this->draws,
        "losses" => $this->losses,
        "points" => $this->points,
        "goaldiff" => $this->goaldiff,
        "for" => $this->for,
        "against" => $this->against,
        "trophies" => $this->trophies
      ];
    }

    public function objectToArray ($object) {
      if(!is_object($object) && !is_array($object))
          return $object;

      return array_map('objectToArray', (array) $object);
  }

    public function updateResultsPlayers($playerOne, $playerTwo, $score)
    {
      $playerOne->setPlayed($playerOne->getPlayed() + 1);
      $playerOne->setGoaldiff($playerOne->getGoaldiff() + $score[0] - $score[1]);
      $playerOne->setFor($playerOne->getFor() + $score[0]);
      $playerOne->setAgainst($playerOne->getAgainst() + $score[1]);
      $playerTwo->setPlayed($playerTwo->getPlayed() + 1);
      $playerTwo->setGoaldiff($playerTwo->getGoaldiff() + $score[1] - $score[0]);
      $playerTwo->setFor($playerTwo->getFor() + $score[1]);
      $playerTwo->setAgainst($playerTwo->getAgainst() + $score[0]);
      if ($score[0] > $score[1]) {
        $playerOne->setPoints($playerOne->getPoints() + 3);
        $playerOne->setWins($playerOne->getWins() + 1);
        $playerTwo->setLosses($playerTwo->getLosses() + 1);
      } elseif ($score[0] == $score[1]) {
        $playerOne->setPoints($playerOne->getPoints() + 1);
        $playerOne->setDraws($playerOne->getDraws() + 1);
        $playerTwo->setPoints($playerTwo->getPoints() + 1);
        $playerTwo->setDraws($playerTwo->getDraws() + 1);
      } elseif ($score[0] < $score[1]) {
        $playerOne->setLosses($playerOne->getLosses() + 1);
        $playerTwo->setPoints($playerTwo->getPoints() + 3);
        $playerTwo->setWins($playerTwo->getWins() + 1);
      };
    }
}
