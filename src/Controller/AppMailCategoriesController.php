<?php

namespace App\Controller;

use App\Entity\AppMailCategories;
use App\Form\AppMailCategoriesType;
use App\Repository\AppMailCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/app/mail/categories')]
class AppMailCategoriesController extends AbstractController
{
    #[Route('/', name: 'app_mail_categories_index', methods: ['GET'])]
    public function index(AppMailCategoriesRepository $appMailCategoriesRepository): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();

                // Récupérer tous les catégories de l'utilisateur
                $categories = $appMailCategoriesRepository->findBy(['user' => $userId]);



        return $this->render('app_mail_categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'app_mail_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AppMailCategoriesRepository $appMailCategoriesRepository): Response
    {

        $user = $this->getUser();


        $appMailCategory = new AppMailCategories();
        $form = $this->createForm(AppMailCategoriesType::class, $appMailCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appMailCategory->setUser($user);

            $appMailCategoriesRepository->save($appMailCategory, true);
            return $this->redirectToRoute('app_mail_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app_mail_categories/new.html.twig', [
            'app_mail_category' => $appMailCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mail_categories_show', methods: ['GET'])]
    public function show(AppMailCategories $appMailCategory): Response
    {
        return $this->render('app_mail_categories/show.html.twig', [
            'app_mail_category' => $appMailCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mail_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AppMailCategories $appMailCategory, AppMailCategoriesRepository $appMailCategoriesRepository): Response
    {
        $form = $this->createForm(AppMailCategoriesType::class, $appMailCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appMailCategoriesRepository->save($appMailCategory, true);

            return $this->redirectToRoute('app_mail_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app_mail_categories/edit.html.twig', [
            'app_mail_category' => $appMailCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mail_categories_delete', methods: ['POST'])]
    public function delete(Request $request, AppMailCategories $appMailCategory, AppMailCategoriesRepository $appMailCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appMailCategory->getId(), $request->request->get('_token'))) {
            $appMailCategoriesRepository->remove($appMailCategory, true);
        }

        return $this->redirectToRoute('app_mail_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
