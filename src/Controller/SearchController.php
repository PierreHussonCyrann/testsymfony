<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categories;
use App\Entity\Films;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="recherche")
     */
    public function indexSearch(Request $request)
    {
        $search = NULL;
        $em = $this->getDoctrine()->getManager();
        $categ = $em->getRepository(Categories::class)->findAll();

        $formulaire  = $this->createFormBuilder()
            ->add('categorie', EntityType::class, array(
                'required'      => true,
                'placeholder'=>'choisissez une categorie',
                'class'         => 'App\Entity\Categories',
                'choice_value'  => 'id',
                'choice_label'  => 'categorie'))
            ->add('titre', TextType::class, array('attr' => array('placeholder' => 'titre')))
            ->add('rechercher', SubmitType::class, array('label' => 'rechercher'))
            ->getForm();

        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $search = $formulaire->getData();

            $resultats = $em->getRepository(Films::class)->Search($search);
            return $this->render('search/index.html.twig',array('categ' => $categ,
                'formulaire' => $formulaire->createView(),'resultats' => $resultats));

        }

        return $this->render('search/index.html.twig', [
            'categ' => $categ,
            'formulaire' => $formulaire->createView(),
        ]);
    }


}
