<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\CategoriesArticles;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('titre',null,[
                'attr'=>[
                    'required' => true,
                ]
            ])
            ->add('numeroParution')
            ->add('contenu', TextareaType::class, [
                'attr' => [
                    'id' => 'editor1',
                    'name' => 'editor1',
                    'rows' => 40,
                    'cols' => 40
                ],
                'required' => true,


            ])
            ->add('imageArticles', VichImageType::class, [
                    'label' => 'Image de l\'article'
                ]

            )
            ->add('categories', EntityType::class, [
                'class' => 'App\Entity\CategoriesArticles',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.id !=1 ' );
                },
                'choice_label' => 'libelle',
                'placeholder' => 'Sélectionnez la rubrique',
                'label' => 'Rubrique',
                'priority' => 150,
                 'required' => true,
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
