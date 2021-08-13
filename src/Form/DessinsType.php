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

class DessinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('titre')
            ->add('auteur', EntityType::class, [
                'class' => 'App\Entity\Equipe',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.role LIKE :r' )
                    ->setParameter('r', 'dessinateurs%');
                },
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez l\'auteur du dessin',
                'label' => 'Dessinateur',
                'required'=> true

            ])
//            ->add('ImageFile', VichImageType::class,[
//                'label'=>'Le dessins',
//
//            ])
            ->add('images', FileType::class,[
                'label' => 'les dessins (20 max)',
                'multiple' => true,
                'mapped' => false,
                'required' => true
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dessins::class,
        ]);
    }
}
