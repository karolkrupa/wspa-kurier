<?php

namespace App\Form;

use App\Entity\Courier;
use App\Entity\Parcel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

class ParcelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextType::class, [
                'label' => "Zawartość",
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole jest wymagane'
                    ])
                ]
            ])
            ->add('additionalInformations', TextType::class, [
                'label' => 'Dodatkowe Informacje'
            ])
            ->add('senderAddress', AddressType::class, [
                'label' => 'Nadawca',
                'constraints' => [
                    new Valid()
                ]
            ])
            ->add('recipientAddress', AddressType::class, [
                'label' => 'Adresat',
                'constraints' => [
                    new Valid()
                ]
            ])->add('submit', SubmitType::class, [
                'label' => 'Zamów'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parcel::class,
        ]);
    }
}
