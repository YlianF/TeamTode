<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class TimtodeController extends AbstractController
{
    public int $ID_JEU = 1;
    #[Route('/timtode', name: 'app_timtode')]
    public function index(Environment $twig, AnnoncesRepository $AnnoncesRepository): Response
    {
        return $this->render('timtode/index.html.twig', [
            'controller_name' => 'TimtodeController',
            'annonces' => $AnnoncesRepository->findBy(['jeu' => $this->ID_JEU], ['date' => 'DESC']),
        ]);
    }
}
