<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Movie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @FileStore\Uploadable
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_filmu", type="string", length=255)
     */
    private $nazwaFilmu;

    /**
     * @var string
     *
     * @ORM\Column(name="gatunek_filmu", type="string", length=255)
     */
    private $gatunekFilmu;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_filmu", type="text")
     */
    private $opisFilmu;

    /**
     * @var string
     *
     * @ORM\Column(name="lista_aktorow", type="string", length=255)
     */
    private $listaAktorow;

    /**
     * @var array
     * @Assert\Image( maxSize="20M")
     * @FileStore\UploadableField(mapping="movie")
     * @ORM\Column(name="okladka", type="array")
     */
    private $okladka;

    /**
     * @var string
     *
     * @ORM\Column(name="cena_filmu", type="decimal")
     */
    private $cenaFilmu;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwaFilmu
     *
     * @param string $nazwaFilmu
     * @return Movie
     */
    public function setNazwaFilmu($nazwaFilmu)
    {
        $this->nazwaFilmu = $nazwaFilmu;

        return $this;
    }

    /**
     * Get nazwaFilmu
     *
     * @return string 
     */
    public function getNazwaFilmu()
    {
        return $this->nazwaFilmu;
    }

    /**
     * Set gatunekFilmu
     *
     * @param string $gatunekFilmu
     * @return Movie
     */
    public function setGatunekFilmu($gatunekFilmu)
    {
        $this->gatunekFilmu = $gatunekFilmu;

        return $this;
    }

    /**
     * Get gatunekFilmu
     *
     * @return string 
     */
    public function getGatunekFilmu()
    {
        return $this->gatunekFilmu;
    }

    /**
     * Set opisFilmu
     *
     * @param string $opisFilmu
     * @return Movie
     */
    public function setOpisFilmu($opisFilmu)
    {
        $this->opisFilmu = $opisFilmu;

        return $this;
    }

    /**
     * Get opisFilmu
     *
     * @return string 
     */
    public function getOpisFilmu()
    {
        return $this->opisFilmu;
    }

    /**
     * Set listaAktorow
     *
     * @param string $listaAktorow
     * @return Movie
     */
    public function setListaAktorow($listaAktorow)
    {
        $this->listaAktorow = $listaAktorow;

        return $this;
    }

    /**
     * Get listaAktorow
     *
     * @return string 
     */
    public function getListaAktorow()
    {
        return $this->listaAktorow;
    }

    /**
     * Set okladka
     *
     * @param array $okladka
     * @return Movie
     */
    public function setOkladka($okladka)
    {
        $this->okladka = $okladka;

        return $this;
    }

    /**
     * Get okladka
     *
     * @return array 
     */
    public function getOkladka()
    {
        return $this->okladka;
    }

    /**
     * Set cenaFilmu
     *
     * @param string $cenaFilmu
     * @return Movie
     */
    public function setCenaFilmu($cenaFilmu)
    {
        $this->cenaFilmu = $cenaFilmu;

        return $this;
    }

    /**
     * Get cenaFilmu
     *
     * @return string 
     */
    public function getCenaFilmu()
    {
        return $this->cenaFilmu;
    }
}
