<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\CategoriesArticles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticlesEditoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('titre')
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
            ;




    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
