<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom',null, [
                'required' =>true
            ])
            ->add('description')
//            ->add('Prix')
            ->add('ImageFile', VichImageType::class,[
                'label'=>'Le dessins',

            ])
            ->add('urlLiseuse',null, [
                'mapped'=>false
            ])
       //     ->add('Date')
//            ->add('Created_at')
//            ->add('Updated_at')
//            ->add('featured')
//            ->add('disponible')
//            ->add('VersionPapier')
//            ->add('VersionNumerique')
//            ->add('Categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
