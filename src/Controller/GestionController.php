<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Entity\Films;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class GestionController extends AbstractController
{

	/**
     * @Route("/add", name="add_film")
     *@param \Swift_Mailer         $mailer
     */
    public function add(Request $request, \Swift_Mailer         $mailer)
    {
        $this->mailer=$mailer;
		$film = new Films();
        $form = $this->createFormBuilder($film)
            ->add('titre', TextType::class)
			->add('description', TextareaType::class)
			->add('categorie', EntityType::class, array(
                'required'      => true,
                'class'         => 'App\Entity\Categories',
                'choice_value'  => 'id',
                'choice_label'  => 'categorie'))
			->add('photo', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer la fiche'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $film = $form->getData();
            $film->setDateajout(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            $subject = 'Une fiche du film'.$film->getTitre().' a été créée !';
            $recipient = getenv('TMA_DEV_EMAIL');
            $message = (new \Swift_Message($subject))
                ->setFrom([getenv('SYSTEM_SENDER_EMAIL') => getenv('SYSTEM_SENDER_NAME')])
                ->setTo($recipient)
                ->setBody(
                    $body = $this->render(
                        'emails/mail.html.twig'
                ));
            $this->mailer->send($message);
            return $this->redirectToRoute('index');
        }

        return $this->render('gestion/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/gestion/modify/{id}", name="modifier_fiche")
     * @param \Swift_Mailer         $mailer
     * @Template("/gestion/new.html.twig", vars={"id"})
     */
    public function update(Request $request, $id,\Swift_Mailer         $mailer){

        $this->mailer=$mailer;
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Films::class)
            ->find($id);

        $form = $this->createFormBuilder($film)
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class)
            ->add('categorie', EntityType::class, array(
                'required'      => true,
                'class'         => 'App\Entity\Categories',
                'choice_value'  => 'id',
                'choice_label'  => 'categorie'))
            ->add('photo', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer la fiche'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $film = $form->getData();
            $film->setDateajout(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            $subject = 'Une fiche du film'.$film->getTitre().' a été modifiée !';
            $recipient = getenv('TMA_DEV_EMAIL');
            $message = (new \Swift_Message($subject))
                ->setFrom([getenv('SYSTEM_SENDER_EMAIL') => getenv('SYSTEM_SENDER_NAME')])
                ->setTo($recipient)
                ->setBody(
                    $body = $this->render(
                        'emails/mail.html.twig'
                    ));
            $this->mailer->send($message);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();


            return $this->redirectToRoute('index');
        }

        return $this->render('gestion/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }


	/**
     * @Route("/gestion/delete/{id}", name="del-film")
     * @Template(vars={"id"})
     */
    public function suppress(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $supprfilm = $em->getRepository(Films::class)
            ->find($id);

        $em->remove($supprfilm);
        $em->flush();

        //faire le mailer ici


        return $this->redirectToRoute('index');
    }
}
