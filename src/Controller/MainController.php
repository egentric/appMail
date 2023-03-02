<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MainController extends AbstractController
{
    #[IsGranted('ROLE_USER')]

    #[Route('/', name: 'home')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'users' => $userRepository->findBy([],['id'=>'DESC'],3),

        ]);
    }
   

}
