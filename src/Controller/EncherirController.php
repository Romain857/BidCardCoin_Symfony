<?php

namespace App\Controller;

use App\Entity\Acheteur;
use App\Entity\Encherir;
use App\Entity\Lot;
use App\Entity\Personne;
use App\Form\EncherirType;
use App\Repository\EncherirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/encherir")
 */
class EncherirController extends AbstractController
{
    /**
     * @Route("/", name="encherir_index", methods={"GET"})
     */
    public function index(EncherirRepository $encherirRepository): Response
    {
        return $this->render('encherir/index.html.twig', [
            'encherirs' => $encherirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="encherir_new", methods={"GET","POST"})
     */
    public function new(Request $request, Lot $lot, EncherirRepository $encherirRepository): Response
    {
        $encherir = new Encherir();
        $encherir -> setIdLot($lot);
        $encherir -> setIdPersonne($this->getUser());
        $encherir->setHeure(new \DateTime('now', new \DateTimeZone('Europe/Paris')));

        if($encherirRepository->bestEnchere($lot->getId()) == null){
            $bestEnchere = 0;
        }
        else{
            $bestEnchere = $encherirRepository->bestEnchere($lot->getId())[0];
        }

        $form = $this->createForm(EncherirType::class, $encherir, array('bestEnchere' => $bestEnchere));
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($encherir);
            $entityManager->flush();

            return $this->redirectToRoute('encherir_index');
        }

        return $this->render('encherir/new.html.twig', [
            'bestEnchere' => $encherirRepository->bestEnchere($lot->getId()),
            'encherir' => $encherir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="encherir_show", methods={"GET"})
     */
    public function show(Encherir $encherir): Response
    {
        return $this->render('encherir/show.html.twig', [
            'encherir' => $encherir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="encherir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Encherir $encherir): Response
    {
        $form = $this->createForm(EncherirType::class, $encherir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('encherir_index');
        }

        return $this->render('encherir/edit.html.twig', [
            'encherir' => $encherir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="encherir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Encherir $encherir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$encherir->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($encherir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('encherir_index');
    }
}
