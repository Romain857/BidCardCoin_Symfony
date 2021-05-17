<?php

namespace App\Controller;

use App\Entity\Lot;
use App\Entity\Produit;
use App\Form\LotType;
use App\Repository\EnchereRepository;
use App\Repository\LotRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lot")
 */
class LotController extends AbstractController
{
    /**
     * @Route("/", name="lot_index", methods={"GET"})
     */
    public function index(LotRepository $lotRepository): Response
    {
        return $this->render('lot/index.html.twig', [
            'lots' => $lotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lot = new Lot();
        $form = $this->createForm(LotType::class, $lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lot);
            $entityManager->flush();

            return $this->redirectToRoute('lot_index');
        }

        return $this->render('lot/new.html.twig', [
            'lot' => $lot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lot_show", methods={"GET"})
     */
    public function show(Lot $lot, EnchereRepository $encheres): Response
    {
        return $this->render('lot/show.html.twig', [
            'lot' => $lot,
            'bestEnchere' => $encheres->findBy( //prend toutes les enchères
                ['idLot' => $lot->getId()], //correspondant à l'idLot correspondant
                ['estimation_actuelle' =>'DESC']) //ordonnés avec le montant décroissant
            [0]
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lot $lot): Response
    {
        $form = $this->createForm(LotType::class, $lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lot_index');
        }

        return $this->render('lot/edit.html.twig', [
            'lot' => $lot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lot $lot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lot_index');
    }
    /**
     * @Route ("/produit/{id}", name="voirProduits")
     */
    public function voirProduits($id, Lot $lot,LotRepository $lotRepository, ProduitRepository $produitRepository){
        $repo=$this->getDoctrine()->getRepository(Lot::class);
        $lot=$repo->find($id);

        $produits=$lot->getProduits();

        return $this->render("lot/voirProduit.html.twig",[
            "produits"=>$produits,
            "lot"=>$lot,
        ]);
    }
}
