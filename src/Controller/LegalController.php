<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalController extends AbstractController
{
    #[Route('/privacy-policy', name: 'legal_policy')]
    public function privacyPolicy(): Response
    {
        return $this->render('legal/policy.html.twig', [
        ]);
    }

    #[Route('/legal-notice', name: 'legal_notice')]
    public function legalNotice(): Response
    {
        return $this->render('legal/notice.html.twig', [
        ]);
    }
}
