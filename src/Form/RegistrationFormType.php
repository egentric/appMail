<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('users_firstName')
            ->add('users_lastName')
            ->add('users_center')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utlisation.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répétez le mot de passe'],
                
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                // 'mapped' => false,
                // 'attr' => ['autocomplete' => 'new-password'],
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => "Merci d'entrer un mot de passe",
                //     ]),
                //     new Length([
                //         'min' => 6,
                //         'minMessage' => "Votre mot de passe n'a pas {{ limit }} caractères minimum",
                //         // max length allowed by Symfony for security reasons
                //         'max' => 4096,
                //     ]),
                // ],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
