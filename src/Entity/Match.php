<?php

namespace AppBundle\Entity;

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
}
