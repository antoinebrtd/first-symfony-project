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
        "name" => $this->name,
        "for" => $this->for,
        "id" => $this->id,
        "against" => $this->against
      ];
    }

    public function updateResultsPlayerOne($score)
    {
      $this->setPlayed($this->getPlayed() + 1);
      $this->setGoaldiff($this->getGoaldiff() + $score[0] - $score[1]);
      $this->setFor($this->getFor() + $score[0]);
      $this->setAgainst($this->getAgainst() + $score[1]);
      if ($score[0] > $score[1]) {
        $this->setPoints($this->getPoints() + 3);
        $this->setWins($this->getWins() + 1);
      } elseif ($score[0] == $score[1]) {
        $this->setPoints($this->getPoints() + 1);
        $this->setDraws($this->getDraws() + 1);
      } elseif ($score[0] < $score[1]) {
        $this->setLosses($this->getLosses() + 1);
      };
    }

    public function updateResultsPlayerTwo($score)
    {
      $this->setPlayed($this->getPlayed() + 1);
      $this->setGoaldiff($this->getGoaldiff() + $score[1] - $score[0]);
      $this->setFor($this->getFor() + $score[1]);
      $this->setAgainst($this->getAgainst() + $score[0]);
      if ($score[1] > $score[0]) {
        $this->setPoints($this->getPoints() + 3);
        $this->setWins($this->getWins() + 1);
      } elseif ($score[1] == $score[0]) {
        $this->setPoints($this->getPoints() + 1);
        $this->setDraws($this->getDraws() + 1);
      } elseif ($score[1] < $score[0]) {
        $this->setLosses($this->getLosses() + 1);
      };
    }
}
