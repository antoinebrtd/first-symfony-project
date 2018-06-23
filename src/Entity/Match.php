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
     * @ORM\Column(type="string")
     */
    private $date;

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
}
