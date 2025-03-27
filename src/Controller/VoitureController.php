<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoitureController extends AbstractController
{
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
}
