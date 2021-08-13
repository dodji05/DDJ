<?php

namespace App\Form;

use App\Entity\Dessins;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LockyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('titre')
           ->add('images', FileType::class,[
            'label' => 'les dessins (20 max)',
            'multiple' => true,
            'mapped' => false,
            'required' => true
        ])

          /*  ->add('ImageFile', VichImageType::class,[
                'label'=>'le dessins de locky / bd',

            ])*/


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dessins::class,
        ]);
    }
}
