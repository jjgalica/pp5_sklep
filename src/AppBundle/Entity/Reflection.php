<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reflection
 *
 * @ORM\Table(options={"collate"="utf8"})
 * @ORM\Entity
 */
class Reflection
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
     * @ORM\Column(name="text", type="text", options={"collate"="utf8"})
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="movie_id", type="integer")
     */
    private $movie_id;

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
     * Set text
     *
     * @param string $text
     * @return Reflection
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set movie_id
     *
     * @param integer $movieId
     * @return Reflection
     */
    public function setMovieId($movieId)
    {
        $this->movie_id = $movieId;

        return $this;
    }

    /**
     * Get movie_id
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->movie_id;
    }
}
