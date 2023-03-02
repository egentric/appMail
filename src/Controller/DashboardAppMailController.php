<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardAppMailController extends AbstractController
{
    #[Route('/dashboard/app/mail', name: 'app_dashboard_app_mail')]
    public function index(): Response
    {
        return $this->render('dashboard_app_mail/index.html.twig', [
            'controller_name' => 'DashboardAppMailController',
        ]);
    }
}
