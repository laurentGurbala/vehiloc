<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoitureController extends AbstractController
{
    /**
     * Page principale
     */
    #[Route('/', name: 'app_home')]
    public function index(VoitureRepository $repository): Response
    {
        // Récupère toutes les voitures
        $voitures = $repository->findAll();

        // Affiche la page d'acceuil avec la liste des voitures
        return $this->render('index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * Affiche le détail d'une voiture
     */
    #[Route("/voiture/{id}", name: "app_voiture", requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(?Voiture $voiture): Response
    {
        // Si aucune voiture n'a été trouvé, rediriger 
        if (!$voiture) {
            return $this->redirectToRoute("app_home");
        }

        // Affiche le détail de la voiture
        return $this->render("voiture/show.html.twig", [
            "voiture" => $voiture,
        ]);
    }

    /**
     * Suppression d'une voiture
     */
    #[Route("/voiture/{id}/supprimer", name: "app_voiture_supprimer", requirements: ["id" => "\d+"])]
    public function remove(?Voiture $voiture, EntityManagerInterface $entityManager)
    {
        // Si aucune voiture n'a été trouvé... 
        if (!$voiture) {
            // Rediriger sur la page principale
            return $this->redirectToRoute("app_home");
        }

        // Supprimer la voiture
        $entityManager->remove($voiture);
        $entityManager->flush();

        // Rediriger sur la page principale
        return $this->redirectToRoute("app_home");
    }

    #[Route("/voiture/ajouter", name: "app_voiture_ajouter", methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer une instance de voiture
        $voiture = new Voiture();

        // Créer le formulaire
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        // Si le formulaire est envoyé et valide...
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement en base de données
            $entityManager->persist($voiture);
            $entityManager->flush();

            // Rediriger vers le détail de la voiture
            return $this->redirectToRoute("app_voiture", ["id" => $voiture->getId()]);
        }

        // Afficher le formulaire d'ajout
        return $this->render("voiture/new.html.twig", [
            "form" => $form,
        ]);
    }
}
