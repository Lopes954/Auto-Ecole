<?php

namespace App\Form;

use App\Entity\User;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // ->add('username', TextType::class, [
            //     'attr' => [
            //         'class' => 'form-control'

            //     ],
            // ])
            ->add('nom', TextType::class, [
                
                'attr' => [
                    'placeholder' => 'nom',
                    'class' => 'form-control'
                    

                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'prénom',
                    'class' => 'form-control'

                ]
            ])
            ->add('telephone', TelType::class, [
                'attr' => [
                    'placeholder' => 'téléphone',
                    'class' => 'form-control'

                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'email',
                    'class' => 'form-control'

                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder' => 'adresse',
                    'class' => 'form-control'

                ]
            ])
            ->add('age', BirthdayType::class, [
                'attr' => [
                    'placeholder' => 'date de naissance',
                    // 'class' => 'form-control'

                ]
            ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                // 'attr' => ['autocomplete' => 'new-password'],
                'attr' => [
                    'placeholder' => 'mot de passe',
                    'class' => 'form-control'

                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'veuillez entrer le mot de passe',
                    ]),

                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
