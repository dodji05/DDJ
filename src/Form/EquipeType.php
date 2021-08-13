<?php

namespace App\Form;

use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('role', ChoiceType::class,[
                'choices' => [
                    'Dessinateurs' => "dessinateurs",
                    'Redacteurs' => 'redacteurs',
                    'Crocs niqueurs' => 'crocsniqueurs',
                ]
            ])
            ->add('ImageFile', VichImageType::class,[
                'label'=>'Une photo',

            ])
            ->add('facebook')
            ->add('linkedin')
            ->add('twitter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
