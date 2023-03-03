<?php

namespace App\Form;

use App\Entity\AppMailContacts;
use App\Entity\AppMailCategories;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class AppMailContactsType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();

        $builder
            ->add('appMail_contacts_email')
            ->add('appMail_contacts_firstName')
            ->add('appMail_contacts_lastName')
            ->add('appMail_contacts_business')
            ->add('category', EntityType::class, [
                'class' => AppMailCategories::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'appMail_categories_name',
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('c')
                        ->where('c.user = :user')
                        ->setParameter('user', $user);
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AppMailContacts::class,
        ]);
    }
}

