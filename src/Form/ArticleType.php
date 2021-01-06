<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('prix')
            ->add('taille')
            ->add('poids')
            ->add('auteur')
            ->add('origine')
            ->add('vendu')
            ->add('categorie')
            ->add('quantite')
            ->add('options',EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
