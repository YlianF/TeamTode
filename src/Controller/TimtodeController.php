<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimtodeController extends AbstractController
{
    #[Route('/timtode', name: 'app_timtode')]
    public function index(): Response
    {
        return $this->render('timtode/index.html.twig', [
            'controller_name' => 'TimtodeController',
        ]);
    }
}
