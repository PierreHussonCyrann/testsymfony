<?php
namespace App\Service;
use App\Entity\Films;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class Counter
{
    private $counter;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em= $em;

    }

    public function FindCountFilms()
    {
        $this->counter = $this->em->getRepository(Films::class)->FindCountFilms();
        return ($this->counter);
    }
}