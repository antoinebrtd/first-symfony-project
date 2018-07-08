<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="games")
 */
class Match
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="array", length=2)
     */
    private $players;

    /**
     * @ORM\Column(type="array", length=2)
     */
    private $score;

    /**
     * @ORM\Column(type="array", length=2)
     */
    private $teams;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date;

    public function __construct($parameters) {
      foreach($parameters as $key => $value) {
          $this->$key = $value;
      }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function getTeams()
    {
        return $this->teams;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setPlayers($players)
    {
        $this->players = $players;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function setTeams($teams)
    {
        $this->teams = $teams;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function matchToJson()
      {
        return [
          "id" => $this->id,
          "players" => $this->players,
          "teams" => $this->teams,
          "score" => $this->score,
          "date" => $this->date
        ];
      }
}
