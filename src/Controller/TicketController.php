<?php

namespace App\Controller;

use App\Entity\Ticket;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TicketFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;
use Knp\Component\Pager\PaginatorInterface;

class TicketController extends AbstractController
{
    #[Route('/ticket', name: 'app_ticket')]
    public function index(Request $request, Environment $twig, EntityManagerInterface $entityManager): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketFormType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            $ticket->setAuthor($this->getUser());
            $ticket->setIsProcessed(false);

            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TickerController',
            'form' => $form,
        ]);
    }
}
