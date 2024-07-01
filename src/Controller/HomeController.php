<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Event\ContactRequestEvent;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ProjectRepository $repository, MailerInterface $mailer, EventDispatcherInterface $dispatcher): Response
    {
        $projects = $repository->findProjectsPinned();

        $contactDTO = new ContactDTO();
        $form = $this->createForm(ContactType::class, $contactDTO);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $dispatcher->dispatch(new ContactRequestEvent($contactDTO));
                $this->addFlash('success', 'Le message à été envoyé avec succès.');
                return $this->redirectToRoute('home');
            } catch (\Exception $e) {
                $this->addFlash('danger', "Impossible d'envoyer le mail");
            }
        }
        
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'form' => $form
        ]);
    }
}
