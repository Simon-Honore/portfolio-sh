<?php

namespace App\Controller\admin;

use App\Entity\Technology;
use App\Form\TechnologyType;
use App\Repository\TechnologyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/technology', name: 'admin_technology_')]
#[IsGranted('ROLE_ADMIN')]
class TechnologyController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TechnologyRepository $repository): Response
    {
        $technologies = $repository->findAll();
        return $this->render('admin/technology/index.html.twig', [
            'technologies' => $technologies,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $technology = new Technology();
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($technology);
            $em->flush();
            $this->addFlash('success', 'La technologie a été créé avec succès.');
            return $this->redirectToRoute('admin_technology_index');
        }
        return $this->render('admin/technology/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', requirements: ['id' => Requirement::DIGITS], methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Technology $technology): Response
    {
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La technologie a été modifiée avec succès.');
            return $this->redirectToRoute('admin_technology_index');
        }
        return $this->render('admin/technology/edit.html.twig', [
            'form' => $form,
            'technology' => $technology
        ]);
    }

    #[Route('/{id}', name: 'delete', requirements: ['id' => Requirement::DIGITS], methods: ['DELETE'])]
    public function delete(Technology $technology, EntityManagerInterface $em)
    {
        $em->remove($technology);
        $em->flush();
        $this->addFlash('success', 'La technologie a été supprimée.');
        return $this->redirectToRoute('admin_technology_index');
    }
}
