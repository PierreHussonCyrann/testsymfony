<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmsRepository")
 */
class Films
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "le titre doit au moins faire 10 lettres")
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="films")
     */
    private $categorie;

    /**
     * @ORM\Column(type="datetime", name="date_ajout", length=255)
     */
	protected $dateajout;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id=$id;
        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
	
	 public function getDateajout()
    {
        return $this->dateajout;
    }

    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($id)
    {
        $this->categorie = $id;

        return $this;
    }
    public function getNbFilms() {

        return $this->createQueryBuilder('f')

            ->select('COUNT(f.titre)')

            ->getQuery()

            ->getSingleScalarResult();

    }
}
