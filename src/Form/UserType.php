<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType
{
    private $token;
    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->token->getToken()->getUser();
        $userId = $user->getId();
        // dd($user->getRoles());
        if ($user->getRoles() == 'ROLE_ADMIN') {

            $builder
                ->add('email')
                ->add('roles', ChoiceType::class, [
                    'choices' => [
                        'Administrateur' => User::ROLE_ADMIN,
                        'Utilisateur' => User::ROLE_USER,
                    ],
                    'multiple' => true,
                    'expanded' => true,
                    'required' => true,
                ])
                // ->add('password')
                ->add('users_firstName')
                ->add('users_lastName')
                ->add('users_center');
        } else {
            $builder
                ->add('email')
                ->add('users_firstName')
                ->add('users_lastName')
                ->add('users_center');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
