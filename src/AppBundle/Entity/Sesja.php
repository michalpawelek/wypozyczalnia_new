<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sesja
 *
 * @ORM\Table(name="sesja", indexes={@ORM\Index(name="id_uzytkownicy", columns={"id_uzytkownik"})})
 * @ORM\Entity
 */
class Sesja
{
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=100, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="id_sesja", type="string", length=60)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSesja;

    /**
     * @var \AppBundle\Entity\Uzytkownicy
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzytkownicy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_uzytkownik", referencedColumnName="id_uzytkownik")
     * })
     */
    private $idUzytkownik;


}

