<?php

namespace App\Form;

use App\Entity\AppMailContacts;
use App\Entity\AppMailCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppMailContactsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('appMail_contacts_email')
            ->add('appMail_contacts_firstName')
            ->add('appMail_contacts_lastName')
            ->add('appMail_contacts_business')
            ->add('category', EntityType::class,[
                'class' => AppMailCategories::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'appMail_categories_name'

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
