<?php

namespace App\Controller;

use App\Entity\Films;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Knp\Bundle\PaginatorBundle\DependencyInjection\KnpPaginatorExtension;
use Knp;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $listefilmssnnpaginee = $em->getRepository(Films::class)->findAll();
        $listefilms  = $this->get('knp_paginator')->paginate(
            $listefilmssnnpaginee,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            10);/*nbre d'éléments par page*/
        return $this->render('index/index.html.twig',['liste'=>$listefilms]);
    }

    /**
     * @Route("/tags", name="tags")
     */
    public function indexTags()
    {
        $em = $this->getDoctrine()->getManager();
        $listecateg = $em->getRepository(Categories::class)->findAll();
        return $this->render('index/index.html.twig',['listecateg'=>$listecateg]);
    }

    /**
     * @Route("/tags/{categorie}", name="singletag")
     * @Template("/index/index.html.twig", vars={"categorie"})
     */
    public function indexSingleTag(Request $request, $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $categ= $em->getRepository(Categories::class)->findOneBy(array('categorie'=>$categorie))->getId();
        $listefilms = $em->getRepository(Films::class)->findBy(array('categorie'=>$categ));
        $listefilmspaginee  = $this->get('knp_paginator')->paginate(
            $listefilms,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            10);/*nbre d'éléments par page*/
        return $this->render('index/index.html.twig',['liste'=>$listefilmspaginee]);
    }
}
