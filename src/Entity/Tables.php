<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match")
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
     * @ORM\Column(type="date")
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

/**
 * @ORM\Entity
 * @ORM\Table(name="player")
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
     * @ORM\Column(type="integer")
     */
    private $for;

    /**
     * @ORM\Column(type="integer")
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
}

/**
 * @ORM\Entity
 * @ORM\Table(name="team")
 */
class Team
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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

/**
 * @ORM\Entity
 * @ORM\Table(name="trophy")
 */
class Trophy
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
     * @ORM\Column(type="string")
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
