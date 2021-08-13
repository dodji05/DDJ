<?php

namespace App\Form;

use App\Entity\CategoriesArticles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', null, [
                'label' => 'Nom de la rubrique',
                'required' => true
            ])
//            ->add('slug')
//            ->add('createdat')
//            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoriesArticles::class,
        ]);
    }



}
