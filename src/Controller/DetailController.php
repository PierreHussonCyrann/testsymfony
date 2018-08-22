<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\Films;
class DetailController extends AbstractController
{
    /**
     * @Route("/{categorie}/{titre}-{id}", name="detail")
     * @Template(vars={"categorie", "titre", "id"})
     */
    public function indexOneFilm($categorie, $titre, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $film= $em->getRepository(Films::class)->findOneBy(array('id'=>$id));

        return $this->render('detail/index.html.twig', [
            'titre' => $titre,
            'categorie' => $categorie,
            'film' => $film
        ]);
    }
}
