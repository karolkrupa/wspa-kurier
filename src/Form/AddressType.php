<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
                'label' => 'Imię',
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ])
                ]
            ])
            ->add('lastName', null, [
                'label' => 'Naziwsko',
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ])
                ]
            ])
            ->add('email', null, [
                'label' => 'E-mail',
                'attr' => [
                    'placeholder' => 'email@wspa.pl'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ]),
                    new Email([
                        'message' => 'To nie jest prawidłowy adres email'
                    ])
                ]
            ])
            ->add('street', null, [
                'label' => 'Adres',
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ])
                ]
            ])
            ->add('city', null, [
                'label' => 'Miasto',
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ])
                ]
            ])
            ->add('postalCode', null, [
                'label' => 'Kod pocztowy',
                'attr' => [
                    'placeholder' => '12-200'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
