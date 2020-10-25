<?php

namespace App\Controller;

use App\Entity\Participant;
//use App\Form\ParticipantSupprimerType;
use App\Form\ParticipantSupprimerType;
use App\Form\ParticipantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant", name="participant")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Participant::class);

        $Participant = $repository->findAll();

        return $this->render('participant/index.html.twig', [
            'participant' => $Participant,
        ]);
    }

    /**
     * @Route("/participant/ajouter", name="participant_ajouter")
     */
    public function ajouter(Request $request){

        $participant=new Participant();

        $form = $this->createForm(ParticipantType::class,$participant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('participant');
        }

        return $this->render("participant/ajouter.html.twig",[

            "formulaire"=>$form->createView()
        ]);
    }
    /**
     * @Route("/participant/modifier/{id}", name="participant_modifier")
     */

    public function modifier($id, Request $request){

        $repo = $this->getDoctrine()->getRepository(Participant::class);
        $participant=$repo->find($id);

        $form = $this->createForm(ParticipantType::class,$participant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('participant');
        }

        return $this->render("participant/modifier.html.twig",[
            "formulaire"=>$form->createView(),
            "participant"=>$participant
        ]);
    }

    /**
     * @Route("/participant/supprimer/{id}", name="participant_supprimer")
     */

    public function supprimer($id, Request $request){

        $repo = $this->getDoctrine()->getRepository(Participant::class);
        $participant=$repo->find($id);

        $form = $this->createForm(ParticipantSupprimerType::class,$participant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush();

            return $this->redirectToRoute('participant');
        }

        return $this->render("participant/supprimer.html.twig",[
            "formulaire"=>$form->createView(),
            "participant"=>$participant
        ]);
    }
}