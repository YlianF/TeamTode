<?php

namespace App\Controller;
use App\Entity\Annonces;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class TimtodeController extends AbstractController
{
    public int $ID_JEU = 1;
    #[Route('/timtode', name: 'app_timtode')]
    public function index(AnnoncesRepository $AnnoncesRepository): Response
    {
        return $this->render('timtode/index.html.twig', [
            'controller_name' => 'TimtodeController',
            'annonces' => $AnnoncesRepository->findBy(['jeu' => $this->ID_JEU], ['date' => 'DESC']),
        ]);
    }

    #[Route('/timtode/annonce/{id}', name: 'app_timtode_annonce')]
    public function show(Environment $twig, Annonces $annonce): Response
    {
        return $this->render('timtode/annonce.html.twig', [
            'controller_name' => 'TimtodeController',
            'annonce' => $annonce,
        ]);
    }
}
