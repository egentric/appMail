<?php

namespace App\Controller;

use App\Entity\AppMailContacts;
use App\Entity\AppMailCategories;
use App\Form\AppMailContactsType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppMailContactsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\AppMailCategoriesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/app/mail/contacts')]
class AppMailContactsController extends AbstractController
{


    #[Route('/', name: 'app_mail_contacts_index', methods: ['GET'])]
    public function index(AppMailContactsRepository $appMailContactsRepository, AppMailCategoriesRepository $appMailCategoriesRepository): Response
    {

        $user = $this->getUser();
        $userId = $user->getId();

        // Récupérer tous les contacts de l'utilisateur
        $contacts = $appMailContactsRepository->findBy(['user' => $userId]);

        $categories = $appMailCategoriesRepository->findAll();

        return $this->render('app_mail_contacts/index.html.twig', [
            'categories' => $categories,
            'contacts' => $contacts,
        ]);
    }


    #[Route('/filter', name: 'app_mail_contacts_filter_categories', methods: ['GET'])]

    public function filterbyCategory(Request $request, AppMailContactsRepository $appMailContactsRepository, AppMailCategoriesRepository $appMailCategoriesRepository)
    {

        $user = $this->getUser();
        $userId = $user->getId();


        $categoryId = $request->query->get('category');
        $contacts = $appMailContactsRepository->findBy(
            ['user' => $userId],

        );

        $categories = $appMailCategoriesRepository->findAll();
// dd($categoryId);

        return $this->render('app_mail_contacts/indexFilter.html.twig', [
            'contacts' => $contacts,
            'categories' => $categories,
            'category_id' => $categoryId,
        ]);

    }


    #[Route('/new', name: 'app_mail_contacts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AppMailContactsRepository $appMailContactsRepository): Response
    {
        $user = $this->getUser();


        $appMailContact = new AppMailContacts();
        $form = $this->createForm(AppMailContactsType::class, $appMailContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appMailContact->setUser($user);

            $appMailContactsRepository->save($appMailContact, true);
            return $this->redirectToRoute('app_mail_contacts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app_mail_contacts/new.html.twig', [
            'app_mail_contact' => $appMailContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mail_contacts_show', methods: ['GET'])]
    public function show(AppMailContacts $appMailContact): Response
    {
        return $this->render('app_mail_contacts/show.html.twig', [
            'app_mail_contact' => $appMailContact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mail_contacts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AppMailContacts $appMailContact, AppMailContactsRepository $appMailContactsRepository): Response
    {
        $form = $this->createForm(AppMailContactsType::class, $appMailContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appMailContactsRepository->save($appMailContact, true);

            return $this->redirectToRoute('app_mail_contacts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app_mail_contacts/edit.html.twig', [
            'app_mail_contact' => $appMailContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mail_contacts_delete', methods: ['POST'])]
    public function delete(Request $request, AppMailContacts $appMailContact, AppMailContactsRepository $appMailContactsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $appMailContact->getId(), $request->request->get('_token'))) {
            $appMailContactsRepository->remove($appMailContact, true);
        }

        return $this->redirectToRoute('app_mail_contacts_index', [], Response::HTTP_SEE_OTHER);
    }
}
