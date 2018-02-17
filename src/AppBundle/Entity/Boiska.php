<?php

    namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boiska
 *
 * @ORM\Table(name="boiska")
 * @ORM\Entity
 */
class Boiska
{
    /**
     * @var string
     *
     * @ORM\Column(name="miejscowosc", type="string", length=30, nullable=false)
     */
    private $miejscowosc;

    /**
     * @var string
     *
     * @ORM\Column(name="ulica", type="string", length=30, nullable=false)
     */
    private $ulica;

    /**
     * @var integer
     *
     * @ORM\Column(name="numer", type="integer", nullable=false)
     */
    private $numer;

    /**
     * @var string
     *
     * @ORM\Column(name="typ", type="string", length=32, nullable=true)
     */
    private $typ;

    /**
     * @var integer
     *
     * @ORM\Column(name="cena_godzina", type="integer", nullable=true)
     */
    private $cenaGodzina;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=200, nullable=false)
     */
    private $img;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_boiska", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBoiska;

    /**
     * @return string
     */
    public function getMiejscowosc()
    {
        return $this->miejscowosc;
    }

    /**
     * @param string $miejscowosc
     */
    public function setMiejscowosc($miejscowosc)
    {
        $this->miejscowosc = $miejscowosc;
    }

    /**
     * @return string
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * @param string $ulica
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;
    }

    /**
     * @return int
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * @param int $numer
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;
    }

    /**
     * @return string
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * @param string $typ
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
    }

    /**
     * @return int
     */
    public function getCenaGodzina()
    {
        return $this->cenaGodzina;
    }

    /**
     * @param int $cenaGodzina
     */
    public function setCenaGodzina($cenaGodzina)
    {
        $this->cenaGodzina = $cenaGodzina;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return int
     */
    public function getIdBoiska()
    {
        return $this->idBoiska;
    }
}

