<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,[
                'attr'=>[
                    'placeholder'=>'Nom & prénom',
                ]
            ])
            ->add('email',null,[
                'attr'=>[
                    'placeholder'=>'Mon email',
                ]
            ])
            ->add('telephone',null,[
                'attr'=>[
                    'placeholder'=>'Mon téléphone',
                ]
            ])
            ->add('objet',null,[
                'attr'=>[
                    'placeholder'=>'Objet',
                ]
            ])
            ->add('message')
//            ->add('lu')
//            ->add('dateEnvoi')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
