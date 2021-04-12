<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\ArrayType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Nume',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă un nume!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('last_name', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Prenume',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă un prenume!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'E-mail',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă un e-mail!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('country', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Țara',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă Țara!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('region', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Județ',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă județul!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('city', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Oraș',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă orașul!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('adress', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Adresa',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă adresa!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('zipcode', NumberType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Cod poștal',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă codul poștal!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])
            ->add('age', NumberType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Vârsta',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă vârsta!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])

            ->add('phone', NumberType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Număr de telefon',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă numărul de telefon!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])
            ->add('username', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Username',
                    'class' => 'form-control',
                    'oninvalid' => 'this.setCustomValidity("Adaugă un username!")',
                    'oninput' => 'this.setCustomValidity("")',
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Parolele trebuie sa se portivească',
                'first_options' => [
                    'label' => ' ',
                    'attr'  => [
                        'placeholder' => 'Parolă',
                        'class' => 'form-control',
                        'oninvalid' => 'this.setCustomValidity("Adaugă o parolă!")',
                        'oninput' => 'this.setCustomValidity("")',
                    ]
                ],
                'second_options' => [
                    'label' => ' ',
                    'attr' => [
                        'placeholder' => 'Confirmă parola',
                        'class' => 'form-control',
                        'oninvalid' => 'this.setCustomValidity("Confirmă parola!")',
                        'oninput' => 'this.setCustomValidity("")',
                    ]
                ]
            ])

            ->add('roles', HiddenType::class, [
                'data' => 'ROLE_USER'
            ])
            ->add('Inregistrare', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}