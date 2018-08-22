<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    const Code_western   = '1';
    const Code_horreur  = '2';
    const Code_fantastique   = '3';
    const Code_comedie   = '4';
    const Code_drame   = '5';
    const Code_navet  = '6';
    const Code_action  = '7';
    const Code_blacksploitation  = '8';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

	/**
     * @ORM\Column(type="string", name="categorie", length=255, nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Films::class, mappedBy="categorie")
     */
    private $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id=$id;
        return $this;
    }

    public function getCategorie(): string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getFilms()
    {
        return $this->films;
    }

    public function addFilms(Films $film)
    {
        if (!$this->films->contains($film))
        {
            $this->films[] = $film;
            $film->setTitre($this);
        }

        return $this;
    }

    public function removeFilms(Films $film)
    {
        {
            if ($this->films->contains($film)) {
                $this->films->removeElement($film);
            }

            return $this;
        }
    }
    
}
