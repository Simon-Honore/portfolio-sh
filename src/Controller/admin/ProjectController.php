<?php

namespace App\Controller\admin;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/project', name: 'admin_project_')]
#[IsGranted('ROLE_ADMIN')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProjectRepository $repository): Response
    {
        $projects = $repository->findAll();
        return $this->render('admin/project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($project);
            $em->flush();
            $this->addFlash('success', 'Le projet a été créé avec succès.');
            return $this->redirectToRoute('admin_project_index');
        }
        return $this->render('admin/project/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', requirements: ['id' => Requirement::DIGITS], methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Le projet a été modifié avec succès.');
            return $this->redirectToRoute('admin_project_index');
        }
        return $this->render('admin/project/edit.html.twig', [
            'form' => $form,
            'project' => $project
        ]);
    }

    #[Route('/{id}', name: 'delete', requirements: ['id' => Requirement::DIGITS], methods: ['DELETE'])]
    public function delete(Project $project, EntityManagerInterface $em)
    {
        $em->remove($project);
        $em->flush();
        $this->addFlash('success', 'Le projet a été supprimé.');
        return $this->redirectToRoute('admin_project_index');
    }
}
