<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Comment;

use App\Form\CommentFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Knp\Component\Pager\PaginatorInterface;

class TimtodeController extends AbstractController
{
    public int $ID_JEU = 1;
    #[Route('/timtode', name: 'app_timtode')]
    public function index(Request $request, AnnoncesRepository $AnnoncesRepository, PaginatorInterface $paginator): Response
    {
        $annonces = $AnnoncesRepository->findBy(['jeu' => $this->ID_JEU], ['date' => 'DESC']);

        $annoncesPaginees = $paginator->paginate(
            $annonces, 
            $request->query->getInt('page', 1), 
            5
        );
        
        
        return $this->render('timtode/index.html.twig', [
            'controller_name' => 'TimtodeController',
            'annonces' => $annoncesPaginees,
        ]);
    }

    #[Route('/timtode/annonce/{id}', name: 'app_timtode_annonce')]
    public function show(Request $request, Environment $twig, Annonces $annonce, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $comment->setAnnonce($annonce);
            $comment->setAuthor($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->render('timtode/annonce.html.twig', [
            'controller_name' => 'TimtodeController',
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }
}
