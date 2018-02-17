<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rezerwacje
 *
 * @ORM\Table(name="rezerwacje", indexes={@ORM\Index(name="id_uzytkownicy", columns={"id_uzytkownik"}), @ORM\Index(name="id_boiska", columns={"id_boiska"})})
 * @ORM\Entity
 */
class Rezerwacje
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wypozyczenia", type="datetime", nullable=true)
     */
    private $dataWypozyczenia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_oddania", type="datetime", nullable=true)
     */
    private $dataOddania;

    /**
     * @var integer
     *
     * @ORM\Column(name="oplata", type="integer", nullable=true)
     */
    private $oplata;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_rezerwacje", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRezerwacje;

    /**
     * @var \AppBundle\Entity\Uzytkownicy
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzytkownicy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_uzytkownik", referencedColumnName="id_uzytkownik")
     * })
     */
    private $idUzytkownik;

    /**
     * @var \AppBundle\Entity\Boiska
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Boiska")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_boiska", referencedColumnName="id_boiska")
     * })
     */
    private $idBoiska;

    /**
     * @return \DateTime
     */
    public function getdata_wypozyczenia()
    {
        return $this->dataWypozyczenia;
    }

    /**
     * @param \DateTime $dataWypozyczenia
     */
    public function setdata_wypozyczenia($dataWypozyczenia)
    {
        $this->dataWypozyczenia = $dataWypozyczenia;
    }

    /**
     * @return \DateTime
     */
    public function getdata_oddania()
    {
        return $this->dataOddania;
    }

    /**
     * @param \DateTime $dataOddania
     */
    public function setdata_oddania($dataOddania)
    {
        $this->dataOddania = $dataOddania;
    }

    /**
     * @return int
     */
    public function getOpłata()
    {
        return $this->oplata;
    }

    /**
     * @param int $oplata
     */
    public function setOpłata($oplata)
    {
        $this->oplata = $oplata;
    }

    /**
     * @return int
     */
    public function getid_rezerwacje()
    {
        return $this->idRezerwacje;
    }

    /**
     * @return Uzytkownicy
     */
    public function getid_uzytkownik()
    {
        return $this->idUzytkownik;
    }

    /**
     * @param Uzytkownicy $idUzytkownik
     */
    public function setid_uzytkownik($idUzytkownik)
    {
        $this->idUzytkownik = $idUzytkownik;
    }

    /**
     * @return Boiska
     */
    public function getid_boiska()
    {
        return $this->idBoiska;
    }

    /**
     * @param Boiska $idBoiska
     */
    public function setid_boiska($idBoiska)
    {
        $this->idBoiska = $idBoiska;
    }


}

