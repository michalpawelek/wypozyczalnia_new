<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Table(name="logs", indexes={@ORM\Index(name="id_uzytkownicy", columns={"id_uzytkownik"}), @ORM\Index(name="id_uzytkownicy_2", columns={"id_uzytkownik"})})
 * @ORM\Entity
 */
class Logs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_uzytkownik", type="integer", nullable=false)
     */
    private $idUzytkownik;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="browser", type="string", length=30, nullable=false)
     */
    private $browser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_log", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;


}

