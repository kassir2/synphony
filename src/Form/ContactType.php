<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le sujet est obligatoire',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le sujet doit contenir au moins {{ limit }} caractères',
                        'max' => 255,
                        'maxMessage' => 'Le sujet doit contenir au maximum {{ limit }} caractères',
                    ])
                ],
            ])
            ->add('email', EmailType::class,[
            'label' => 'Email',
            'constraints' =>[
                new Email([
                    'message'=>'This is not the corect email format'
                ]),
                new NotBlank([
                    'message' => 'This field can not be blank'
                ])
            ],
        ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le message est obligatoire',
                    ]),
                    
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}